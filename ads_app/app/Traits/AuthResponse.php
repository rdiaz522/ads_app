<?php

namespace App\Traits;

use \Illuminate\Http\JsonResponse;

trait AuthResponse
{
    public static function message(string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $status
        ], $status);
    }

    public static function errorMessage(string $errors, string $message, int $status = 401): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
            'message' => $message,
            'status' => $status
        ], $status);
    }
}

