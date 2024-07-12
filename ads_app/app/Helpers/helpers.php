<?php

use Illuminate\Support\Facades\Cookie;

if (!function_exists('getCurrentUser')) {
    function getCurrentUser() {
        $token = \cookie('token');
        if ($token) {
            $user = JWTAuth::setToken($token)->authenticate();

            if ($user) {
                return $user;
            }
        }

        return null;
    }
}

if (!function_exists('generateGUID')) {
    function generateGUID() {
        mt_srand((double)microtime() * 10000);
        $charId = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = substr($charId, 0, 8) . $hyphen
            . substr($charId, 8, 4) . $hyphen
            . substr($charId, 12, 4) . $hyphen
            . substr($charId, 16, 4) . $hyphen
            . substr($charId, 20, 12);
        return $uuid;
    }
}
