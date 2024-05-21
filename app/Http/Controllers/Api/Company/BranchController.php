<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Company\BranchRequest;
use App\Http\Resources\Api\Company\BranchCollection;
use App\Http\Resources\Api\Company\BranchResource;
use App\Models\Api\Company\Branch;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BranchController extends Controller
{
    public function index()
    {
        $rescourceCollection = Branch::with('company')->FetchData(request('sort'), request('filter'), request('fields'))->get();
        return BranchCollection::make($rescourceCollection);
    }

    public function store(BranchRequest $request)
    {
        $model = Branch::SaveResource($request->validated());
        return response()->json([BranchResource::make($model)], Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $resource = Branch::findOrFail($id);
        return response()->json([BranchResource::make($resource)]);
    }

    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
