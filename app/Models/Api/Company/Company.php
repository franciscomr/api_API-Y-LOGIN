<?php

namespace App\Models\Api\Company;

use App\Traits\Api\FetchData;
use App\Traits\Api\FindSingleResource;
use App\Traits\Api\InsertCreatedByAndUpdatedBy;
use App\Traits\Api\SaveResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, FetchData, FindSingleResource, SaveResource, InsertCreatedByAndUpdatedBy;

    protected $fillable = [
        'name',
        'business_name',
        'address',
        'city',
        'state',
        'postal_code'
    ];

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
