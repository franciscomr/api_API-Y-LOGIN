<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Company\PositionRequest;
use App\Http\Resources\Api\Company\PositionCollection;
use App\Http\Resources\Api\Company\PositionResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Api\Company\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $rescourceCollection = Position::with('department')->FetchData(request('sort'), request('filter'), request('fields'))->get();
        return PositionCollection::make($rescourceCollection);
    }

    public function store(PositionRequest $request)
    {
        $resource = Position::CreateResource($request->validated());
        return response()->json([PositionResource::make($resource)], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $resource = Position::FindSingleResource($id);
        return response()->json([PositionResource::make($resource)], Response::HTTP_OK);
    }

    public function update(PositionRequest $request, $id)
    {
        $resource = Position::UpdateResource($request->validated(), $id);
        return response()->json([PositionResource::make($resource)], Response::HTTP_OK);
    }
}
