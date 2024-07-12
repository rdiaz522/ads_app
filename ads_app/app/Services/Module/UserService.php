<?php


namespace App\Services\Module;

use App\Repositories\Module\UsersRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function createUser()
    {
        $this->userRepository->createRecord();
    }

    public function getUser()
    {
//        $user = $this->userRepository->getRecordById($this->user->id);
//
//        return $user;
    }
}
