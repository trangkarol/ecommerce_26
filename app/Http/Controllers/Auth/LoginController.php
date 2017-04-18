<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->userRepository = $userRepository;
    }

    /**
     * login.
     *
     * @return void
     */
    public function index()
    {
        return view('admin.common.login');
    }

    /**
     * login to website
     *
     * @return void
     */
    public function login(LoginRequest $request)
    {
        $result = $this->userRepository->login($request);
        if ($result) {
            $request->session()->flash('success', trans('user.msg.login-success'));

            if (Auth::user()->role == config('setting.role.admin')) {
                return redirect()->action('Admin\ProductController@index');
            }

            return redirect()->action('Member\HomeController@index');
        }

        $request->session()->flash('fail', trans('user.msg.login-fail'));

        return redirect()->action('Auth\LoginController@index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logout(Request $request)
    {
        $result = $this->userRepository->logout($request);
        if ($result) {
            $request->session()->flash('success', trans('user.msg.logout-success'));

            return redirect()->action('Member\HomeController@index');
        }

        $request->session()->flash('fail', trans('user.msg.logout-fail'));

        return redirect()->back();
    }
}
