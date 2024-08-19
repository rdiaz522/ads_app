<?php

namespace App\Http\Controllers;

use App\Traits\AuthResponse;
use App\Traits\Credentials;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, AuthResponse, Credentials;

    /**
     * @var null
     */
    public $user;

    public function __construct()
    {
        if (empty($this->user)) {
            $this->user = $this->getCurrentUser();
        }
    }
}
