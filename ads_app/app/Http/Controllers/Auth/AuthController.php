<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Traits\AuthResponse;
use App\Traits\AuthToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    use AuthResponse;
    use AuthToken;

    /**
     * Get a JWT via given credentials.
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');
        $token = Auth::attempt($credentials);

        if ($token) {
            $request->session()->put('token', $token);
            $cookie = Cookie::make(config('custom.jwt_key'), $token, config('jwt.ttl'));
            return $this->respondWithToken($token)->withCookie($cookie);
        }

        return self::errorMessage('Incorrect Username or Password!', 'Invalid Credential');
    }


    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            Auth::logout();
            auth()->invalidate();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $request->session()->forget('token');
            $removeJwtCookie = Cookie::forget(config('custom.jwt_key'));
            return self::message('Successfully logged out')->withCookie($removeJwtCookie);
        } catch (JWTException $error) {
            return response()->json(['error' => $error->getMessage()], 401);
        }
    }

    /**
     * Refresh a token.
     * @param Request $request
     * @param Response $response
     * @return JsonResponse
     */
    public function refresh(Request $request, Response $response): JsonResponse
    {
        $this->refreshToken($request, $response);
        return $response;
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }

}
