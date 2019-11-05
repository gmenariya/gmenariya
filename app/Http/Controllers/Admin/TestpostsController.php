<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestpostRequest;
use App\Http\Requests\StoreTestpostRequest;
use App\Http\Requests\UpdateTestpostRequest;
use App\Testpost;
use App\Xcategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestpostsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('testpost_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testposts = Testpost::all();

        return view('admin.testposts.index', compact('testposts'));
    }

    public function create()
    {
        abort_if(Gate::denies('testpost_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $xcaregories = Xcategory::all()->pluck('name', 'id');

        return view('admin.testposts.create', compact('categories', 'xcaregories'));
    }

    public function store(StoreTestpostRequest $request)
    {
        $testpost = Testpost::create($request->all());
        $testpost->xcaregories()->sync($request->input('xcaregories', []));

        return redirect()->route('admin.testposts.index');
    }

    public function edit(Testpost $testpost)
    {
        abort_if(Gate::denies('testpost_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $xcaregories = Xcategory::all()->pluck('name', 'id');

        $testpost->load('category', 'xcaregories');

        return view('admin.testposts.edit', compact('categories', 'xcaregories', 'testpost'));
    }

    public function update(UpdateTestpostRequest $request, Testpost $testpost)
    {
        $testpost->update($request->all());
        $testpost->xcaregories()->sync($request->input('xcaregories', []));

        return redirect()->route('admin.testposts.index');
    }

    public function show(Testpost $testpost)
    {
        abort_if(Gate::denies('testpost_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testpost->load('category', 'xcaregories');

        return view('admin.testposts.show', compact('testpost'));
    }

    public function destroy(Testpost $testpost)
    {
        abort_if(Gate::denies('testpost_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testpost->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestpostRequest $request)
    {
        Testpost::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
