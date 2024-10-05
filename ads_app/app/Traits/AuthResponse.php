<?php

namespace App\Traits;

use \Illuminate\Http\JsonResponse;

trait AuthResponse
{
    /**
     * Success Message Response Handler
     *
     * @param string $message
     * @param integer $status
     * @return JsonResponse
     */
    public static function message(string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $status
        ], $status);
    }

    /**
     * Error Message Response Handler
     *
     * @param string $errors
     * @param string $message
     * @param integer $status
     * @return JsonResponse
     */
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
