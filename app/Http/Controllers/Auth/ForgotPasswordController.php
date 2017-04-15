<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\ForgotPasswordRequest;
use DB;

class ForgotPasswordController extends Controller
{
    protected $userRepository;
    protected $categoryRepository;

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * get form forgot password.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function index()
    {
        $menus = $this->categoryRepository->getMenu();

        return view('member.user.forgot_password', compact('menus'));
    }

    /**
     * forgotPassword
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function forgotPassword(ForgotPasswordRequest $request)
    {
        $result = $this->userRepository->forgotPassword($request);
        if ($result) {
            $request->session()->flash('success', trans('user.msg.forgotpassword-success'));

            return redirect()->action('Member\HomeController@index');
        }

        $request->session()->flash('fail', trans('user.msg.forgotpassword-fail'));

        return redirect()->action('Member\HomeController@index');
    }
}
