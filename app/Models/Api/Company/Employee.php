<?php

namespace App\Models\Api\Company;

use App\Traits\Api\FetchData;
use App\Traits\Api\FindSingleResource;
use App\Traits\Api\InsertCreatedByAndUpdatedBy;
use App\Traits\Api\SaveResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory, FetchData, FindSingleResource, SaveResource, InsertCreatedByAndUpdatedBy;

    protected $fillable = [
        'branch_id',
        'position_id',
        'name',
        'first_surname',
        'second_surname',
        'identifier',
        'hire_date',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function getRelationshipKeys(): array
    {
        return [
            'branch_id',
            'position_id'
        ];
    }
}
