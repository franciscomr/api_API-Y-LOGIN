<?php

namespace App\Http\Resources\Api\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'employees',
            'id' => (string) $this->resource->id,
            'attributes' => [
                'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
                'first_surname' => $this->when(!is_null($this->resource->first_surname), $this->resource->first_surname),
                'second_surname' => $this->when(!is_null($this->resource->second_surname), $this->resource->second_surname),
                'identifier' => $this->when(!is_null($this->resource->identifier), $this->resource->identifier),
                'hire_date' => $this->when(!is_null($this->resource->hire_date), $this->resource->hire_date),
                'is_active' => $this->when(!is_null($this->resource->is_active), $this->resource->is_active),
                'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
                'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
                'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at),
                'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)
            ],
            'relationships' => [
                'branch' => [
                    'data' => [
                        'type' => 'branches',
                        'id' => $this->resource->branch_id,
                    ]
                ],
                'position' => [
                    'data' => [
                        'type' => 'positions',
                        'id' => $this->resource->position_id,
                    ]
                ]
            ],
            'links' => [
                'self' => route('branches.show', $this->resource->id),
            ]

        ];
    }
}
