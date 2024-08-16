<?php

namespace App\Http\Middleware;

use App\Traits\AuthToken;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{
    use AuthToken;

    public function handle($request, Closure $next, ...$guards)
    {
        $response = $next($request);

        try {
            JWTAuth::parseToken()->authenticate();
            $this->validateToken($request, $response);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is Invalid'], 401);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token is Expired'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Authorization Token not found'], 401);
        }

        return $response;
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return route('login');
    }

}
