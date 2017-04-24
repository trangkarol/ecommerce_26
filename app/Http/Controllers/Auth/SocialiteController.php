<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Auth;
use DB;

class SocialiteController extends Controller
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
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * handleProviderCallback.
     *
     * @return void
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // dd($user);

        $authUser = $this->findOrCreateUser($user, $provider);
        if ($authUser) {
            Auth::login($authUser, true);
        }

        return redirect()->action('Member\HomeController@index');
    }

    /**
     * findOrCreateUser.
     *
     * @return void
     */
    public function findOrCreateUser($user, $provider)
    {
        return $this->userRepository->createSocialite($user, $provider);
    }
}
