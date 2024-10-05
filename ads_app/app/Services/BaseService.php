<?php

namespace App\Services;

use App\Traits\Credentials;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

abstract class BaseService implements BaseServiceInterface
{
    use Credentials;

    /**
     * @var string
     */
    protected $modelName;

    /**
     * @var mixed
     */
    protected mixed $model;

    /**
     * @var null
     */
    protected $user;

    /**
     * @var false
     */
    protected $isNew = false;

    /**
     * Contructor
     */
    public function __construct()
    {
        $modelName = "App\\Models\\" . $this->modelName;
        $this->model = resolve($modelName);
        $this->user = $this->getCurrentUser();
    }

    /**
     * Create Record
     *
     * @param array $data
     * @return Model
     */
    public function createRecord(array $data): Model
    {
        $this->isNew = true;
        $this->model = new $this->model;
        return $this->saveRecord($data);
    }

    /**
     * Get Record by ID
     *
     * @param [type] $id
     * @return Model
     */
    public function getRecordById(string $id): Model
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Get Records
     *
     * @return Collection
     */
    public function getRecords($select = null): Collection
    {
        if (isEmpty($select)) {
            return $this->model->orderBy('created_at', 'desc')->get();
        }

        return $this->model->select($select)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Update Record
     *
     * @param array $data
     * @param string $id
     * @return Model
     */
    public function updateRecord(array $data, string $id): Model
    {
        $this->isNew = false;
        $this->model = $this->model->find($id);
        if ($this->model->exists) {
            return $this->saveRecord($data);
        }

        return $this->model;
    }

    /**
     * Delete record by ID
     *
     * @param string $id
     * @return Model
     */
    public function deleteRecordById(string $id): Model
    {
        try {
            DB::beginTransaction();
            $model = $this->model->find($id);
            if ($model->exists) {
                $model->delete();
            }
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Save Record
     *
     * @param [type] $data
     * @return Model
     */
    protected function saveRecord(array $data): Model
    {
        try {
            DB::beginTransaction();
            $original = $this->model->getAttributes();
            $this->model->fill($data);

            if ($this->isNew) {
                // save new record
                $this->model->save();
            } else {
                // Compare original values with new values
                $changes = [];
                foreach ($this->model->getAttributes() as $key => $value) {
                    if (array_key_exists($key, $original) && $value !== $original[$key]) {
                        $changes[$key] = $value;
                    }
                }

                if ($changes) {
                    // Update only changed fields
                    $this->model->update($changes);
                }
            }

            DB::commit();

            return $this->model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
