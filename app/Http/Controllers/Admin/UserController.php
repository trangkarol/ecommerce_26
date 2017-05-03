<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\InsertUserRequest;
use App\Http\Controllers\Controller;
use App\Helpers\Library;

class UserController extends Controller
{
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Library::getRoles();
        $members = $this->userRepository->getUsers();

        return view('admin.user.index', compact('members', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Library::getRoles();

        return view('admin.user.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertUserRequest $request)
    {
        $result = $this->userRepository->register($request, $request->role);

        if ($result) {
            $request->session()->flash('success', trans('user.msg.insert-success'));

            return redirect()->action('Admin\UserController@edit', $result->id);
        }

        $request->session()->flash('fail', trans('user.msg.insert-fail'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Library::getRoles();
        $user = $this->userRepository->find($id);

        return view('admin.user.edit', compact('role', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsertUserRequest $request, $id)
    {
        $result = $this->userRepository->updateProfile($request, $id, $request->role);

        if ($result) {
            $request->session()->flash('success', trans('user.msg.update-success'));

            return redirect()->action('Admin\UserController@edit', $id);
        }

        $request->session()->flash('fail', trans('user.msg.update-fail'));

        return redirect()->action('Admin\UserController@edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->userRepository->delete($id);

        if ($result) {
            $request->session()->flash('success', trans('user.msg.update-success'));

            return redirect()->action('Admin\UserController@index');
        }

        $request->session()->flash('fail', trans('user.msg.update-fail'));

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * importFile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function importFile($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
       try {
            $input = $request->only(['name', 'email', 'role']);
            $input['active_members'] = isset($request->active_members) ? $request->active_members : 0;
            $members = $this->userRepository->searchUser($input);
            $html = view('admin.user.table_result', compact('members'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (Exception $e) {
            return response()->json('result', false);
        }
    }
}
