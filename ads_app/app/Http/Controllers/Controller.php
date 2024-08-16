<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\AuthResponse;
use App\Traits\Credentials;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;


abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, AuthResponse, Credentials;

    /**
     * @var User
     */
    public null $user;

    public function __construct()
    {
        if (empty($this->user)) {
            $this->user = $this->getCurrentUser();
        }
    }
}
