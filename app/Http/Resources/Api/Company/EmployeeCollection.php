<?php

namespace App\Http\Resources\Api\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $branchRelationships = collect();
        $positionRelationships = collect();

        foreach ($this->collection as $resource) {
            $branchRelationships->push(new BranchResource($resource->branch));
            $positionRelationships->push(new PositionResource($resource->position));
        }
        $branchCollection = new BranchCollection($branchRelationships->unique());
        $positionCollection = new PositionCollection($positionRelationships->unique());
        $includeArray = explode(",", $request->get('include'));

        return [
            'data' => $this->collection,
            'links' => [
                'self' => route('employees.index')
            ],

            'included' => [
                $this->when(in_array('branches', $includeArray), $branchCollection->values()->all()),
                $this->when(in_array('positions', $includeArray), $positionCollection->values()->all())
            ]

        ];
    }
}
