<?php

namespace App\Traits\Api;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait FetchData
{
    public function scopeFetchData(Builder $query,string | null $sortResourcesRequest, array | null $filterResourcesRequest, 
        array  | null $fieldsResourceRequest, string | null $includeRelationshipsRequest) {
            dd($includeRelationshipsRequest);
        $resourceFieldsList = Schema::getColumnListing(self::getTable());
        if (!is_null($sortResourcesRequest)) {
            $this->sortResources($query,$sortResourcesRequest, $resourceFieldsList);
        }

        if (!is_null($filterResourcesRequest)) {
            $this->filterResources($query,$filterResourcesRequest, $resourceFieldsList);
        }

        if(!is_null($fieldsResourceRequest)){
            $this->selectFieldsResources($query,$fieldsResourceRequest, $resourceFieldsList);
        }
    }

    protected function sortResources(Builder $query, string | null $sort, array $resourceFieldsList) {
       $sortArray = explode(",", $sort);

       foreach($sortArray as $sortField) {
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

    protected function filterResources(Builder $query, array | null $filter, array $resourceFieldsList){
        foreach($filter as $keyFilter => $valueFilter) {
            $this->checkIfFieldExists($keyFilter, $resourceFieldsList);
            $query->where($keyFilter, $valueFilter);
        }
        return $query;
    }

    protected function selectFieldsResources(Builder $query, array | null $fields, array $resourceFieldsList) {
        $resourceName = self::getTable();
        //dd(method_exists($this, 'companiess'));
        foreach($fields as $indexField => $valueField){
            if($indexField === $resourceName){
                $valueFieldArray = explode(",", $valueField);

                foreach($valueFieldArray as $value ){
                    $this->checkIfFieldExists($value, $resourceFieldsList);
                }
                if (!in_array('id', $valueFieldArray)) {
                    array_push($valueFieldArray, 'id');
                }
                $query->select($valueFieldArray);
            } 
            
            /*elseif (method_exists($this,$indexField)) {
                $relationFieldsList = Schema::getColumnListing($indexField);
                $valueFieldArray = explode(",", $valueField);
                foreach($valueFieldArray as $value ){
                    $this->checkIfFieldExists($value, $relationFieldsList);
                }
                if (!in_array('id', $valueFieldArray)) {
                    array_push($valueFieldArray, 'id');
                }
                $query->select($valueFieldArray);
            }*/

        }
    }

    protected function checkIfFieldExists(string $field, array $resourceFieldsList){
        if(!in_array($field, $resourceFieldsList)) {
            throw new Exception('invalid Value');
        }
    }
}
