<?php


namespace App\Http\Controllers\Module\Users;


use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class UsersController extends ModuleController
{

    public function getUser()
    {
        return response()->json(['message' => Cookie::get(config('custom.jwt_key'))]);
    }
}
