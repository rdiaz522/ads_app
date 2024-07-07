<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AuthResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use AuthResponse;

    public $expire_ttl;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->expire_ttl = config('jwt.ttl');
    }

    /**
     * Get a JWT via given credentials.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return self::errorMessage('Invalid Credential','Incorrect Username or Password', 401);
        }

        $cookie = Cookie::make(config('custom.jwt_key'), $token, $this->expire_ttl);
        return $this->respondWithToken($token)->withCookie($cookie);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        auth()->invalidate();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $removeJwtCookie = Cookie::forget(config('custom.jwt_key'));
        return self::message('Successfully logged out')->withCookie($removeJwtCookie);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->expire_ttl * 60
        ]);
    }

}
