<?php

namespace App\Services\Module;

use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService
{
    protected $modelName = 'User';

    /**
     * Undocumented function
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        // Business Logic comes here ...
        return $this->createRecord($data);
    }

    public function getUserById($id): string
    {
        return $id;
    }

    public function getDataTable()
    {
        $users = $this->getRecords();
        return $users;
    }

    public function getFullName(string $id): String
    {
        $user = $this->model->where('id', $id)->get();
        return $user->value('fullname');
    }
}
