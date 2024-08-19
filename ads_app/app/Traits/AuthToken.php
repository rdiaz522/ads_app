<?php

namespace App\Traits;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

trait AuthToken {

    /**
     *  Refresh a token and set in the request & response header
     * @param $request
     * @param $response
     * @return void
     */
    public function refreshToken($request, $response) : void
    {
        $token = JWTAuth::getToken();
        $refreshToken = JWTAuth::refresh($token);
        $request->headers->set('Authorization', 'Bearer ' . $refreshToken);
        $response->headers->set('Authorization', 'Bearer ' . $refreshToken);
        $cookie = cookie(config('custom.jwt_key'), $refreshToken, config('jwt.ttl'));
        $response->withCookie($cookie);
        session(['token', $refreshToken]);
    }

    /**
     * This function check the expiration of the token
     * if the token is expired it will refresh the token
     * @param $request
     * @param $response
     * @return JsonResponse|null
     */
    public function validateToken($request, $response) : ?JsonResponse
    {
        try {
            $expire = JWTAuth::getClaim('exp');
            // Calculate time to expiration
            $exp = Carbon::createFromTimestamp($expire);
            $now = Carbon::now();
            $expiresIn = $exp->diffInMinutes($now);
            $expireMin = (int) config('custom.jwt_expire_minute_refresh');
            if ($expiresIn < $expireMin) {
                $this->refreshToken($request, $response);
            }
        } catch (JWTException $error) {
            return response()->json(['error' => $error->getMessage()], 401);
        }

        return null;
    }

}
