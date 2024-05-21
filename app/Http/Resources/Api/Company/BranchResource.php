<?php

namespace App\Http\Resources\Api\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'branches',
            'id' => (string) $this->resource->id,
            'attributes' => [
                'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
                'address' => $this->when(!is_null($this->resource->address), $this->resource->address),
                'city' => $this->when(!is_null($this->resource->city), $this->resource->city),
                'state' => $this->when(!is_null($this->resource->state), $this->resource->state),
                'postal_code' => $this->when(!is_null($this->resource->postal_code), (string) $this->resource->postal_code),
                'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
                'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
                'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at),
                'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)
            ],
            'relationships' => [
                'company' => [
                    'data' => [
                        'type' => 'companies',
                        'id' => $this->resource->company_id,
                    ]
                ]
            ],
            'links' => [
                'self' => route('branches.show',$this->resource->id),
            ]

        ];
    }
}
