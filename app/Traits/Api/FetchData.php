<?php

namespace App\Traits\Api;

use App\Http\Exceptions\JsonApiExceptionResponse;
use App\Http\Exceptions\JsonApiExceptionSchema;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait FetchData
{
    public function scopeFetchData(
        Builder $query,
        string | null $sortRequest,
        array | null $filterRequest,
        array  | null $selectFieldsRequest,
    ) {

        $resourceFieldsList = Schema::getColumnListing(self::getTable());

        if (!is_null($sortRequest)) {
            $this->sortResources($query, $sortRequest, $resourceFieldsList);
        }

        if (!is_null($filterRequest)) {
            $this->filterResources($query, $filterRequest, $resourceFieldsList);
        }

        if (!is_null($selectFieldsRequest)) {
            $this->selectFieldsResources($query, $selectFieldsRequest, $resourceFieldsList);
        }
    }

    protected function sortResources(Builder $query, string | null $sort, array $resourceFieldsList)
    {
        $sortArray = explode(",", $sort);
        foreach ($sortArray as $sortField) {
            $sortDirection = 'ASC';
            if (str_starts_with($sortField, '-')) {
                $sortField = substr($sortField, 1);
                $sortDirection = 'DESC';
            }
            $this->checkIfFieldExists($sortField, $resourceFieldsList);
            $query->orderBy($sortField, $sortDirection);
        }
        return $query;
    }

    protected function filterResources(Builder $query, array | null $filter, array $resourceFieldsList)
    {
        foreach ($filter as $keyFilter => $valueFilter) {
            $this->checkIfFieldExists($keyFilter, $resourceFieldsList);
            $query->where($keyFilter, $valueFilter);
        }
        return $query;
    }

    protected function selectFieldsResources(Builder $query, array | null $fields, array $resourceFieldsList)
    {
        $resourceName = self::getTable();
        foreach ($fields as $indexField => $valueField) {
            if ($indexField === $resourceName) {
                $valueFieldArray = explode(",", $valueField);
                foreach ($valueFieldArray as $value) {
                    $this->checkIfFieldExists($value, $resourceFieldsList);
                }
                if (!in_array('id', $valueFieldArray)) {
                    array_push($valueFieldArray, 'id');
                }
                if (method_exists($this, 'getRelationshipKeys')) {
                    $relationshipKeys = self::getRelationshipKeys();
                    foreach ($relationshipKeys as $relationshipKey) {
                        $this->checkIfFieldExists($relationshipKey, $resourceFieldsList);
                        if (!in_array($relationshipKey, $valueFieldArray)) {
                            array_push($valueFieldArray, $relationshipKey);
                        }
                    }
                }
                $query->select($valueFieldArray);
            }
        }
        return $query;
    }

    protected function checkIfFieldExists(string $field, array $resourceFieldsList)
    {
        if (!in_array($field, $resourceFieldsList)) {
            $error = new JsonApiExceptionSchema(__('api.bad_request_error'), __('api.invalid_parameter_message', ['parameter' => $field]), Response::HTTP_BAD_REQUEST);
            throw new JsonApiExceptionResponse($error);
        }
    }
}
