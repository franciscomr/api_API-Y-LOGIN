<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Company\BranchCollection;
use App\Http\Resources\Api\Company\BranchResource;
use App\Http\Requests\Api\Company\BranchRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Api\Company\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $rescourceCollection = Branch::with('companies')->FetchData(request('sort'), request('filter'), request('fields'))->get();
        return BranchCollection::make($rescourceCollection);
    }

    public function store(BranchRequest $request)
    {
        $resource = Branch::CreateResource($request->validated());
        return response()->json([BranchResource::make($resource)], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $resource = Branch::FindSingleResource($id);
        return response()->json([BranchResource::make($resource)], Response::HTTP_OK);
    }

    public function update(BranchRequest $request, $id)
    {
        $resource = Branch::UpdateResource($request->validated(), $id);
        return response()->json([BranchResource::make($resource)], Response::HTTP_OK);
    }
}
