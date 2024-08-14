<?php


namespace App\Http\Controllers\Module\Users;

use App\Http\Controllers\ModuleController;
use App\Http\Requests\User\UserRequest;
use \Illuminate\Http\JsonResponse;


class UsersController extends ModuleController
{
    /**
     * @var string UserService
     */
    protected string $serviceName = 'UserService';

    /**
     * @return JsonResponse
     */
    public function getUser(): JsonResponse
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
