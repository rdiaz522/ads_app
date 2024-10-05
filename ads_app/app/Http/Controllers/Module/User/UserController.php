<?php


namespace App\Http\Controllers\Module\User;

use App\Http\Controllers\ModuleController;
use App\Http\Requests\User\UserRequest;
use App\Services\Module\UserService;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends ModuleController
{

    public function __construct(protected UserService $userService)
    {
        parent::__construct($userService);
    }

    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $users = $this->service->getRecords();
        return response()->json(['data' => $users]);
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $data = $request->all();
        $user = $this->service->store($data);
        return response()->json([
            'data' => $user,
            'message' => 'Successfully added new user!',
            'success' => true
        ], 201);
    }

    /**
     * Get Users DataTable
     *
     * @return JsonResponse
     */
    public function getUserDataTable(): JsonResponse
    {
        $users = $this->service->getDataTable();

        return response()->json(['data' => $users]);
    }

    public function getUserById($id): JsonResponse
    {
        $user = $this->service->getRecordById($id);

        return response()->json(['data' => $user]);
    }
}
