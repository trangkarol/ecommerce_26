<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryInterface;
use App\Helpers\Library;
use App\Http\Requests\CategoryRequest;
use DB;

class CategoryController extends Controller
{
    protected $categoryRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getCategory();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $typeCategory = Library::typeCategory();

        return view('admin.category.create', compact('parentCategory', 'typeCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        $input['parent_id'] = isset($request->parent_id) ? $request->parent_id : 0;
        $result = $this->categoryRepository->create($input);

        if ($result) {
            $request->session()->flash('success', trans('category.msg.insert-success'));
            DB::rollback();

            return redirect()->action('Admin\CategoryController@edit', $result->id);
        }

        $request->session()->flash('fail', trans('category.msg.insert-fail'));
        DB::rollback();

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
        $category = $this->categoryRepository->find($id);
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $typeCategory = Library::typeCategory();

        return view('admin.category.edit', compact('category', 'parentCategory', 'typeCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $input = $request->all();
        $input['parent_id'] = isset($request->parent_id) ? $request->parent_id : 0;
        $result = $this->categoryRepository->update($input, $id);
        // dd($result);
        if ($result) {
            $request->session()->flash('success', trans('category.msg.edit-success'));

            return redirect()->action('Admin\CategoryController@edit', $request->id);
        }

        $request->session()->flash('fail', trans('category.msg.edit-fail'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->categoryRepository->delete($id);

        if ($result) {
            $request->session()->flash('success', trans('category.msg.delete-success'));

            return redirect()->action('Admin\CategoryController@index');
        }

        $request->session()->flash('fail', trans('category.msg.delete-fail'));

        return redirect()->back();
    }
}
