<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Traits\AuthResponse;
use App\Traits\AuthToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    use AuthResponse;
    use AuthToken;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a JWT via given credentials.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return self::errorMessage('Incorrect Username or Password!','Invalid Credential', 401);
        }

        $request->session()->put('token', $token);
        $cookie = Cookie::make(config('custom.jwt_key'), $token, config('jwt.ttl'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request, Response $response)
    {
       $this->refreshToken($request, $response);

       return $response;
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
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }

}
