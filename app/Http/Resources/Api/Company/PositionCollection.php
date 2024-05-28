<?php

namespace App\Http\Resources\Api\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PositionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $relationships = collect();
        foreach ($this->collection as $resource) {
            $relationships->push(new DepartmentResource($resource->department));
        }
        $departmentCollection = new DepartmentCollection($relationships->unique());
        $includeArray = explode(",", $request->get('include'));

        return [
            'data' => $this->collection,
            'links' => [
                'self' => route('positions.index')
            ],

            'included' => [
                $this->when(in_array('departments', $includeArray), $departmentCollection->values()->all())
            ]

        ];
    }
}
