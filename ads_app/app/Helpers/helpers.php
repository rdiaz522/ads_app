<?php


if (!function_exists('generateGUID')) {
    function generateGUID()
    {
        mt_srand((float)microtime() * 10000);
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

if (!function_exists('isEmpty')) {
    function isEmpty($data)
    {
        if (!isset($data) || empty($data)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('isBcryptHashed')) {
    function isBcryptHashed($data)
    {
        return preg_match('/^\$2[ayb]\$.{56}$/', $data);
    }
}


if (!function_exists('getUserFullName')) {
    function getUserFullName($id)
    {
        $user = \App\Services\Module\UserService::class;
        $fulLname = $user->getFullName($id);
    }
}
