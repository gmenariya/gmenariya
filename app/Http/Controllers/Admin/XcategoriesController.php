<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyXcategoryRequest;
use App\Http\Requests\StoreXcategoryRequest;
use App\Http\Requests\UpdateXcategoryRequest;
use App\Xcategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XcategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('xcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $xcategories = Xcategory::all();

        return view('admin.xcategories.index', compact('xcategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('xcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.xcategories.create');
    }

    public function store(StoreXcategoryRequest $request)
    {
        $xcategory = Xcategory::create($request->all());

        return redirect()->route('admin.xcategories.index');
    }

    public function edit(Xcategory $xcategory)
    {
        abort_if(Gate::denies('xcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.xcategories.edit', compact('xcategory'));
    }

    public function update(UpdateXcategoryRequest $request, Xcategory $xcategory)
    {
        $xcategory->update($request->all());

        return redirect()->route('admin.xcategories.index');
    }

    public function show(Xcategory $xcategory)
    {
        abort_if(Gate::denies('xcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.xcategories.show', compact('xcategory'));
    }

    public function destroy(Xcategory $xcategory)
    {
        abort_if(Gate::denies('xcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $xcategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyXcategoryRequest $request)
    {
        Xcategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
