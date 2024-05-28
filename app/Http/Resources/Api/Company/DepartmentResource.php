<?php

namespace App\Http\Resources\Api\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'departments',
            'id' => (string) $this->resource->id,
            'attributes' => [
                'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
                'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
                'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
                'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at),
                'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)
            ],
            'links' => [
                'self' => route('departments.show', ['id' => $this->resource->id])
            ]
        ];
    }
}
