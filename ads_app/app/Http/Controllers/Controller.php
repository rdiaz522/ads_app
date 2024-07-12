<?php

namespace App\Http\Controllers;

use App\Traits\AuthResponse;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, AuthResponse;

    public $user;

    public function __construct()
    {
//        $this->user = getCurrentUser();
    }


}
