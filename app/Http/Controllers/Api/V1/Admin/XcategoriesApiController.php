<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreXcategoryRequest;
use App\Http\Requests\UpdateXcategoryRequest;
use App\Http\Resources\Admin\XcategoryResource;
use App\Xcategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XcategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('xcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new XcategoryResource(Xcategory::all());
    }

    public function store(StoreXcategoryRequest $request)
    {
        $xcategory = Xcategory::create($request->all());

        return (new XcategoryResource($xcategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Xcategory $xcategory)
    {
        abort_if(Gate::denies('xcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new XcategoryResource($xcategory);
    }

    public function update(UpdateXcategoryRequest $request, Xcategory $xcategory)
    {
        $xcategory->update($request->all());

        return (new XcategoryResource($xcategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Xcategory $xcategory)
    {
        abort_if(Gate::denies('xcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $xcategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
