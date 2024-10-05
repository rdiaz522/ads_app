<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{

    use SoftDeletes;

    /**
     * Everytime creating a new instance of a model
     * it will automatically set the updated by and created by current user.
     * @return void
     */
    protected static function booted(): void
    {
        static::saving(static function ($model) {
            $userId = auth()->id() ?? config('custom.system_user_id');

            if ($model->exists) {
                $model->updated_by = $userId;
            } else {
                if (isEmpty($model->id)) {
                    $model['id'] = generateGUID();
                }
                if (isEmpty($model->created_by)) {
                    $model['created_by'] = $userId;
                }
                if (isEmpty($model->updated_by)) {
                    $model['updated_by'] = $userId;
                }
            }
        });
    }
}
