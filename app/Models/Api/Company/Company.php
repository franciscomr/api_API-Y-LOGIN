<?php

namespace App\Models\Api\Company;

use App\Traits\Api\FetchData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, FetchData;
}
