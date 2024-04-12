<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var User
     */
    public $user;

    protected $currentRequest;

    public function __construct()
    {
        Log::info('This is Controller Module');

        try {
            $this->currentRequest = request();
            $this->user = auth()->user();
            $payload = auth()->payload();
            $claimArr = $payload->get('user');

//            if (empty($claimArr)) {
//                $this->abort('missing_user_session');
//            }
//
//            // expire session if user type is mismatch from the token.
//            if (!empty($claimArr) && ($claimArr['user_type'] !== $this->user->user_type)) {
//                $this->abort('change_user_type');
//            }
//
//            // expire session if login status is mismatch from the token
//            if (!empty($claimArr) && ($claimArr['login_status'] !== $this->user->login_status)) {
//                $this->abort('change_user_status');
//            }
//

        } catch (JWTException $e) { // the token could not be parsed from the request or has expired
            $this->abort('session_expired');
        }
    }


    /**
     * Destroy the JWT Token
     *
     * @param $error
     * @return $this
     */
    public function abort($error)
    {
        Log::info($error);
    }
}
