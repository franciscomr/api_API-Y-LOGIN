<?php

namespace App\Traits\Api;

trait InsertCreatedByAndUpdatedBy
{
    public static function bootInsertCreatedByAndUpdatedBy()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = 'AA Admin';
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = 'CC Admin';
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = 'CC Admin';
            }
        });
    }
}
