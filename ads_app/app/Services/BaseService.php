<?php


namespace App\Services;


abstract class BaseService
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Repository
     */
    public $repo;

    /**
     * BaseService constructor.
     * @param $repo
     */
    protected function __construct($repo)
    {
        $this->repo = $repo;
    }


    protected function createRecord($data): void
    {
        $this->beforeCreate($data);
        $this->repo->createRecord($data);
    }

    protected function beforeCreate(&$data): void
    {
    }


}
