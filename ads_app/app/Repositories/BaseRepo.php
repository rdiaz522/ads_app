<?php


namespace App\Repositories;


abstract class BaseRepo
{
    protected $modelName;

    protected $model;

    protected $user;

    public function __construct()
    {
        $modelName = "App\\Models\\" . $this->modelName;
        $this->model = resolve($modelName);
    }

    public function createRecord(array $data)
    {
        if ($this->model->exists) {
            $test = 0;
        }
    }

    public function getRecordById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getRecords()
    {
        return $this->model->get();
    }
}
