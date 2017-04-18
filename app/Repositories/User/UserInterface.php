<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function login($request);

    public function register($request, $role);

    public function logout($request);

    public function changePassword($request);

    public function createSocialite($user, $provider);

    public function forgotPassword($request);
}
