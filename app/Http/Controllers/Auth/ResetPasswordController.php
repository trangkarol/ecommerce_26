<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\ChangePasswordRequest;
use DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->userRepository = $userRepository;
    }

    /**
     * change password.
     *
     * @param  array  $data
     * @return User
     */
    public function index()
    {
        return view('admin.common.change_password');
    }

    /**
     * change password.
     *
     * @param  array  $data
     * @return User
     */
    public function changePassWord(ChangePasswordRequest $request)
    {
        $result = $this->userRepository->changePassWord($request);
        if ($result) {
            $request->session()->flash('success', trans('user.msg.change-password-success'));

            return redirect()->action('Auth\LoginController@login');
        }

        $request->session()->flash('fail', trans('user.msg.change-password-fail'));

        return redirect()->back();
    }
}
