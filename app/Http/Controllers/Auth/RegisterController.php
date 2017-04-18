<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\User\UserInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\User\InsertUserRequest;
use App\Repositories\Category\CategoryInterface;
use App\Http\Requests\User\UpdateUserRequest;
use DB;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $userRepository;
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserInterface $userRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * get form register.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function index()
    {
        $menus = $this->categoryRepository->getMenu();
        return view('member.user.register', compact('menus'));
    }

    /**
     * register a member.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(InsertUserRequest $request)
    {

        $result = $this->userRepository->register($request, config('setting.role.user'));
        if ($result) {
            Auth::login($result, true);
        }

        return redirect()->action('Member\HomeController@index');
    }

    /**
     * getUpdate a member.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getUpdate($id)
    {
        $user = $this->userRepository->find($id);
        $menus = $this->categoryRepository->getMenu();

        return view('member.user.detail', compact('user', 'menus'));
    }

    /**
     * register a member.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $result = $this->userRepository->update($request, $id);

        return redirect()->action('Auth\RegisterController@getUpdate', $id);
    }
}
