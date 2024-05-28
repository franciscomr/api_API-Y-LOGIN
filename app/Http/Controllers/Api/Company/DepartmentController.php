<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Company\DepartmentRequest;
use App\Http\Resources\Api\Company\DepartmentCollection;
use App\Http\Resources\Api\Company\DepartmentResource;
use App\Models\Api\Company\Department;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    public function index()
    {
        $rescourceCollection = Department::FetchData(request('sort'), request('filter'), request('fields'))->get();
        return DepartmentCollection::make($rescourceCollection);
    }

    public function store(DepartmentRequest $request)
    {
        $resource = Department::CreateResource($request->validated());
        return response()->json([DepartmentResource::make($resource)], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $resource = Department::FindSingleResource($id);
        return response()->json([DepartmentResource::make($resource)], Response::HTTP_OK);
    }

    public function update(DepartmentRequest $request, $id)
    {
        $resource = Department::UpdateResource($request->validated(), $id);
        return response()->json([DepartmentResource::make($resource)], Response::HTTP_OK);
    }
}
