<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Company\EmployeeRequest;
use App\Http\Resources\Api\Company\EmployeeCollection;
use App\Http\Resources\Api\Company\EmployeeResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Api\Company\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $rescourceCollection = Employee::with('branch', 'position')->FetchData(request('sort'), request('filter'), request('fields'))->get();
        return EmployeeCollection::make($rescourceCollection);
    }

    public function store(EmployeeRequest $request)
    {
        $resource = Employee::CreateResource($request->validated());
        return response()->json([EmployeeResource::make($resource)], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $resource = Employee::FindSingleResource($id);
        return response()->json([EmployeeResource::make($resource)], Response::HTTP_OK);
    }

    public function update(EmployeeRequest $request, $id)
    {
        $resource = Employee::UpdateResource($request->validated(), $id);
        return response()->json([EmployeeResource::make($resource)], Response::HTTP_OK);
    }
}
