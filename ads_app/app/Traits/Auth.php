<?php

namespace App\Traits;
use Tymon\JWTAuth\Facades\JWTAuth;

trait Auth {

    public static function refreshToken($request, $response)
    {
        $token = JWTAuth::getToken();
        $refreshToken = JWTAuth::refresh($token);
        $request->headers->set('Authorization', 'Bearer ' . $refreshToken);
        $response->headers->set('Authorization', 'Bearer ' . $refreshToken);
        cookie(config('custom.jwt_key'), $refreshToken, config('jwt.ttl'));
        session(['token', $refreshToken]);
        session(['refreshToken' => 1]);
    }

}
