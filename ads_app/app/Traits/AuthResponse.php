<?php

namespace App\Traits;

trait AuthResponse
{
    public static function message($message, $status = 200)
    {
        return response()->json([
            'message' => $message,
            'status' => $status
        ], $status);
    }

    public static function errorMessage($error, $message, $status = 401)
    {
        return response()->json([
            'error' => $error,
            'message' => $message,
            'status' => $status
        ], $status);
    }
}

