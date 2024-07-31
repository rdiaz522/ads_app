<?php


namespace App\Repositories;


use App\Traits\Credentials;

abstract class BaseRepo
{
    use Credentials;

    protected $modelName;

    protected $model;

    protected $user;

    protected $userId;

    public function __construct()
    {
        $modelName = "App\\Models\\" . $this->modelName;
        $this->model = resolve($modelName);
        $this->user = $this->getCurrentUser();
    }

    public function createRecord(array $data)
    {
        $this->model = new $this->model;
        $this->userId = generateGUID();
        $this->model->id = $this->userId;
        $this->setUpdatedByUser($data);
        $this->setCreatedByUser($data);
        $this->save($data);
    }

    /**
     * This will populate the updated_by field by user_id
     * @param array $data
     */
    protected function setUpdatedByUser(array &$data)
    {
        if (is_array($data) && !empty($data)) {

            $data['updated_by'] = (!empty($data['updated_by']) ? $data['updated_by']
                : $this->user) ? $this->user->id : $this->userId;
        }
    }

    /**
     * This will populate the created_by field by user_id
     * @param array $data
     */
    protected function setCreatedByUser(array &$data)
    {
        if (is_array($data) && !empty($data)) {
            $data['created_by'] = (!empty($data['created_by']) ? $data['created_by']
                : $this->user) ? $this->user->id : $this->userId;
        }
    }

    protected function save($data)
    {
        $this->model->fill($data);
        $this->model->save();
    }

    public function getRecordById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getRecords()
    {
        return $this->model->get();
    }

    protected function beforeCreate(&$data)
    {
    }
}
