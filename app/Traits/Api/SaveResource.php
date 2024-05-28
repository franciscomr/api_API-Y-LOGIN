<?php

namespace App\Traits\Api;

use App\Http\Exceptions\JsonApiExceptionResponse;
use App\Http\Exceptions\JsonApiExceptionSchema;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Database\Eloquent\Builder;

trait SaveResource
{
    public function scopeCreateResource(Builder $query, array $validatedFields)
    {
        $this->checkIfMethodIsValid($method = 'POST');
        try {
            $resource = new self();
            $resource->fill($validatedFields);
            $resource->save();
            return $resource;
        } catch (Exception $e) {
            $error = new JsonApiExceptionSchema(__('api.save_error'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            throw new JsonApiExceptionResponse($error);
        }
    }

    public function scopeUpdateResource(Builder $query, array $validatedFields, int | string $id)
    {
        $this->checkIfMethodIsValid($method = 'PATCH');
        $resource = $this->checkIfResourceExists($id);
        try {
            $resource->fill($validatedFields);
            $resource->save();
            return $resource;
        } catch (Exception $e) {
            $error = new JsonApiExceptionSchema(__('api.save_error'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            throw new JsonApiExceptionResponse($error);
        }
    }

    protected function checkIfMethodIsValid($method)
    {
        if (!request()->isMethod($method)) {
            $error = new JsonApiExceptionSchema(__('api.method_not_allowed_error'), __('api.invalid_method_message', ['method' => $method]), Response::HTTP_METHOD_NOT_ALLOWED);
            throw new JsonApiExceptionResponse($error);
        }
    }

    protected function checkIfResourceExists(int | string $id)
    {
        try {
            return self::findOrFail($id);
        } catch (Exception $e) {
            $error = new JsonApiExceptionSchema(__('api.not_found_error'), __('api.invalid_parameter_message', ['parameter' => $id]), Response::HTTP_NOT_FOUND);
            throw new JsonApiExceptionResponse($error);
        }
    }
}
