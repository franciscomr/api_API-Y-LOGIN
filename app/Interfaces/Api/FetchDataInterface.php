<?php

namespace App\Interfaces\Api;

use Illuminate\Http\JsonResponse;

interface FetchDataInterface
{
    public function filterData():JsonResponse;
}
