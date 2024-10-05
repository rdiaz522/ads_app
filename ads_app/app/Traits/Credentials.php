<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

trait Credentials
{
    /**
     * Get the Current User
     *
     * @return void
     */
    protected function getCurrentUser(): Model | null
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

            throw new Exception($e);
        }

        return null;
    }
}
