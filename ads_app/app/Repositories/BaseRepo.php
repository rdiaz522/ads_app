<?php


namespace App\Repositories;


use App\Traits\Credentials;

abstract class BaseRepo
{
    use Credentials;

    protected $modelName;

    protected mixed $model;

    protected null $user;

    protected string $userId;

    public function __construct()
    {
        $modelName = "App\\Models\\" . $this->modelName;
        $this->model = resolve($modelName);
        $this->user = $this->getCurrentUser();
    }

    /**
     * Create Record
     * @param array $data
     * @return void
     */
    public function createRecord(array $data): void
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
    protected function setUpdatedByUser(array &$data): void
    {
        if (!empty($data)) {
            if (isset($this->user->id) && !empty($this->user->id)) {
                $data['updated_by'] = $this->user->id;
            } else {
                $data['updated_by'] = $this->userId;
            }
        }
    }

    /**
     * This will populate the created_by field by user_id
     * @param array $data
     */
    protected function setCreatedByUser(array &$data): void
    {
        if (!empty($data)) {
            if (isset($this->user->id) && !empty($this->user->id)) {
                $data['created_by'] = $this->user->id;
            } else {
                $data['created_by'] = $this->userId;
            }
        }
    }

    protected function save(array $data): void
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
