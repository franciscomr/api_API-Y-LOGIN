<?php

namespace App\Models\Api\Company;

use App\Traits\Api\FetchData;
use App\Traits\Api\FindSingleResource;
use App\Traits\Api\InsertCreatedByAndUpdatedBy;
use App\Traits\Api\SaveResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    use HasFactory, FetchData, FindSingleResource, SaveResource, InsertCreatedByAndUpdatedBy;

    protected $fillable = [
        'department_id',
        'name',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getRelationshipKeys(): array
    {
        return [
            'department_id'
        ];
    }
}
