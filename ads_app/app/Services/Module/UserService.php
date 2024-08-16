<?php


namespace App\Services\Module;

use App\Repositories\Module\UsersRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{

    public function __construct(UsersRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function create(array $data): void
    {
        $this->createRecord($data);
    }

    public function getUserById($id): string
    {
        return 'TEST';
    }

    protected function beforeCreate(&$data): void
    {
        if (is_array($data) && !empty($data)) {
            $data['password'] = Hash::make($data['password']);
            $data['login_status'] = 'Active';
            $data['user_type'] = 'USER';
        }
    }

}
