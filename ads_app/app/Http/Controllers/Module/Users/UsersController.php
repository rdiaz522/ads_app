<?php


namespace App\Http\Controllers\Module\Users;

use App\Http\Controllers\ModuleController;


class UsersController extends ModuleController
{
    protected $serviceName = 'UserService';

    public function getUser()
    {
        $userId = $this->user->id;
        $user = $this->service->getUser($userId);

        return response()->json(['data' => 'TEST']);
    }
}
