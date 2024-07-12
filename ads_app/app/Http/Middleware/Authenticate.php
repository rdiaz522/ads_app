<?php

namespace App\Http\Middleware;

use App\Traits\Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{
    use Auth;

    public function handle($request, Closure $next, ...$guards)
    {
        $token = Cookie::get(config('custom.jwt_key'));

        $response = $next($request);
        try {
            JWTAuth::parseToken()->authenticate();
            $this->checkTokenValidity($request, $response);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTokenValidity($request, $response)
    {
        try {
            $expire = JWTAuth::getClaim('exp');
            // Calculate time to expiration
            $exp = Carbon::createFromTimestamp($expire);
            $now = Carbon::now();
            $expiresIn = $exp->diffInMinutes($now);
            $expireMin = (int) config('custom.jwt_expire_minute_refresh');
            if ($expiresIn < $expireMin) {
                self::refreshToken();
            }
        } catch (JWTException $error) {
            return response()->json(['error' => $error->getMessage()], 401);
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return route('login');
    }

}
