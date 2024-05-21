<?php

namespace App\Models\Api\Company;

use App\Traits\Api\FetchData;
use App\Traits\Api\InsertCreatedByAndUpdatedBy;
use App\Traits\Api\SaveResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Branch extends Model
{
    use HasFactory, FetchData, SaveResource, InsertCreatedByAndUpdatedBy;

    protected $fillable = [
        'company_id',
        'name',
        'address',
        'city',
        'state',
        'postal_code'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getRelationshipKeys(): array
    {
        return [
            'company_id'
        ];
    }
}
