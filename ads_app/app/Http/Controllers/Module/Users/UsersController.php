<?php


namespace App\Http\Controllers\Module\Users;

use App\Http\Controllers\ModuleController;
use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Facades\Hash;


class UsersController extends ModuleController
{
    protected $serviceName = 'UserService';

    public function getUser()
    {
        $userId = $this->user->id;
        $user = $this->service->getUserById($userId);

        return response()->json(['data' => $user]);
    }

    public function register(UserRequest $request)
    {
        $data = $request->all();
        $user = $this->service->create($data);
    }
}
