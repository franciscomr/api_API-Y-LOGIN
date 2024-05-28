<?php

namespace App\Traits\Api;

use App\Http\Exceptions\JsonApiExceptionResponse;
use App\Http\Exceptions\JsonApiExceptionSchema;
use Symfony\Component\HttpFoundation\Response;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait FindSingleResource
{
    public function scopeFindSingleResource(Builder $query, int | string $id)
    {
        try {
            $resource = self::findOrFail($id);
            return $resource;
        } catch (Exception $e) {
            $error = new JsonApiExceptionSchema(__('api.not_found_error'), __('api.invalid_parameter_message', ['parameter' => $id]), Response::HTTP_NOT_FOUND);
            throw new JsonApiExceptionResponse($error);
        }
    }
}
