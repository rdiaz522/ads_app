<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return route('login');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $response = $next($request);
        try {
            if (JWTAuth::parseToken()->authenticate()) {
               $this->checkTokenValidity($request, $response);
            }
        } catch (JWTException $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['error' => 'Token is Invalid'], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['error' => 'Token is Expired'], 401);
            } else {
                return response()->json(['error' => 'Authorization Token not found'], 401);
            }
        }

        return $response;
    }

    /**
     * This function check the expiration of the token if below refresh minute
     * if the token is expired it will refresh the token and set in the header
     * @param $request
     * @param $response
     */
    public function checkTokenValidity($request, $response)
    {
        $token = JWTAuth::getToken();
        $expire = JWTAuth::getClaim('exp');

        // Calculate time to expiration
        $exp = Carbon::createFromTimestamp($expire);
        $now = Carbon::now();
        $expiresIn = $exp->diffInMinutes($now);

        if ($expiresIn < config('custom', 'jwt_expire_minute_refresh')) {
            $newToken = JWTAuth::refresh($token);
            $request->headers->set('Authorization', 'Bearer ' . $newToken);
            $response->headers->set('Authorization', 'Bearer ' . $newToken);
        }
    }

}
