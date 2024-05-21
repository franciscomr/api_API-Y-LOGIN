<?php

namespace App\Traits\Api;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait UpdateResource
{
    public function scopeUpdateResource(Builder $query, array $validatedFields, int | string $id)
    {
        $this->checkIfMethodIsValid();
        $resource = $this->checkIfResourceExists($id);
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
        if (!request()->isMethod('PUT')) {
            throw new Exception('invalid Method');
        }
    }

    private function checkIfResourceExists(int | string $id)
    {
        try {
            return self::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
