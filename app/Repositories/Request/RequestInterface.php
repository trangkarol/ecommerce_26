<?php

namespace App\Repositories\Request;

interface RequestInterface
{
    public function login($request);

    public function register($request, $role);

    public function logout($request);

    public function changePassword($request);

    public function createSocialite($user, $provider);

    public function forgotPassword($request);
}
