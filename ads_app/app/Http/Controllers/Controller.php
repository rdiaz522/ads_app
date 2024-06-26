<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    }

}
