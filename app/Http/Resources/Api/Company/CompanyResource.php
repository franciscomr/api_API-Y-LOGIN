<?php

namespace App\Http\Resources\Api\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'companies',
            'id' => (string) $this->resource->id,
            'attributes' => [
                'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
                'business_name' => $this->when(!is_null($this->resource->business_name), $this->resource->business_name),
                'address' => $this->when(!is_null($this->resource->address), $this->resource->address),
                'city' => $this->when(!is_null($this->resource->city), $this->resource->city),
                'state' => $this->when(!is_null($this->resource->state), $this->resource->state),
                'postal_code' => (string) $this->when(!is_null($this->postal_code), $this->postal_code),
                'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
                'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
                'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at),
                'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)
            ],
            'links' => [
                'self' =>route('companies.show', ['id' => $this->resource->id])  
            ]
        ];
    }
}
