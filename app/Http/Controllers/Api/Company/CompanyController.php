<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Company\CompanyRequest;
use App\Http\Resources\Api\Company\CompanyCollection;
use App\Http\Resources\Api\Company\CompanyResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Api\Company\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $rescourceCollection = Company::FetchData(request('sort'), request('filter'), request('fields'))->get();
        return CompanyCollection::make($rescourceCollection);
    }

    public function store(CompanyRequest $request)
    {
        $resource = Company::CreateResource($request->validated());
        return response()->json([CompanyResource::make($resource)], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $resource = Company::FindSingleResource($id);
        return response()->json([CompanyResource::make($resource)], Response::HTTP_OK);
    }

    public function update(CompanyRequest $request, $id)
    {
        $resource = Company::UpdateResource($request->validated(), $id);
        return response()->json([CompanyResource::make($resource)], Response::HTTP_OK);
    }
}
