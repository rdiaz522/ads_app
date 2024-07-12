<?php


namespace App\Services;


abstract class BaseService
{
    /**
     * @var User
     */
    public $user;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
//        $this->user = getCurrentUser();
    }

    /**
     * This will populate the created_by field by user_id
     * @param array $data
     */
    public function setCreatedByUser(array $data)
    {
        if (is_array($data) && !empty($data)) {
            $data['created_by'] = !empty($data['created_by']) ? $data['created_by'] : $this->user->id;
        }
    }

    /**
     * This will populate the updated_by field by user_id
     * @param array $data
     */
    public function setUpdatedByUser(array $data)
    {
        if (is_array($data) && !empty($data)) {
            $data['updated_by'] = !empty($data['updated_by']) ? $data['updated_by'] : $this->user->id;
        }
    }

}
