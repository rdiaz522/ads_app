<?php

namespace App\Traits;

trait AuthResponse
{
    public static function message($message, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $status
        ], $status);
    }

    public static function errorMessage($errors, $message, $status = 401)
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
            'message' => $message,
            'status' => $status
        ], $status);
    }
}

