<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

trait Credentials {
    protected function getCurrentUser()
    {
        try {
            $token = Cookie::get(config('custom.jwt_key'));
            if ($token) {
                $user = JWTAuth::setToken($token)->authenticate();

                if ($user) {
                    return $user;
                }
            }
        } catch (\Exception $e) {

        }

        return null;
    }
}
