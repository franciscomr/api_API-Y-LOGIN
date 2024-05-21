<?php

namespace App\Traits\Api;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait SaveResource
{
    public function scopeSaveResource(Builder $query, array $validatedFields)
    {
        $this->checkIfMethodIsValid();
        try {
            $resource = new self();
            $resource->fill($validatedFields);
            $resource->save();
            return $resource;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    protected function checkIfMethodIsValid()
    {
        if (!request()->isMethod('POST')) {
            throw new Exception('invalid Method');
        }
    }
}
