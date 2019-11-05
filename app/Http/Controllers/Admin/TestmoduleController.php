<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTestmoduleRequest;
use App\Http\Requests\StoreTestmoduleRequest;
use App\Http\Requests\UpdateTestmoduleRequest;
use App\Testmodule;
use App\Xcategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestmoduleController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('testmodule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testmodules = Testmodule::all();

        return view('admin.testmodules.index', compact('testmodules'));
    }

    public function create()
    {
        abort_if(Gate::denies('testmodule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Xcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categoryxes = Category::all()->pluck('name', 'id');

        return view('admin.testmodules.create', compact('categories', 'categoryxes'));
    }

    public function store(StoreTestmoduleRequest $request)
    {
        $testmodule = Testmodule::create($request->all());
        $testmodule->categoryxes()->sync($request->input('categoryxes', []));

        if ($request->input('file_singlex', false)) {
            $testmodule->addMedia(storage_path('tmp/uploads/' . $request->input('file_singlex')))->toMediaCollection('file_singlex');
        }

        foreach ($request->input('file_multix', []) as $file) {
            $testmodule->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file_multix');
        }

        return redirect()->route('admin.testmodules.index');
    }

    public function edit(Testmodule $testmodule)
    {
        abort_if(Gate::denies('testmodule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Xcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categoryxes = Category::all()->pluck('name', 'id');

        $testmodule->load('category', 'categoryxes');

        return view('admin.testmodules.edit', compact('categories', 'categoryxes', 'testmodule'));
    }

    public function update(UpdateTestmoduleRequest $request, Testmodule $testmodule)
    {
        $testmodule->update($request->all());
        $testmodule->categoryxes()->sync($request->input('categoryxes', []));

        if ($request->input('file_singlex', false)) {
            if (!$testmodule->file_singlex || $request->input('file_singlex') !== $testmodule->file_singlex->file_name) {
                $testmodule->addMedia(storage_path('tmp/uploads/' . $request->input('file_singlex')))->toMediaCollection('file_singlex');
            }
        } elseif ($testmodule->file_singlex) {
            $testmodule->file_singlex->delete();
        }

        if (count($testmodule->file_multix) > 0) {
            foreach ($testmodule->file_multix as $media) {
                if (!in_array($media->file_name, $request->input('file_multix', []))) {
                    $media->delete();
                }
            }
        }

        $media = $testmodule->file_multix->pluck('file_name')->toArray();

        foreach ($request->input('file_multix', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $testmodule->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file_multix');
            }
        }

        return redirect()->route('admin.testmodules.index');
    }

    public function show(Testmodule $testmodule)
    {
        abort_if(Gate::denies('testmodule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testmodule->load('category', 'categoryxes');

        return view('admin.testmodules.show', compact('testmodule'));
    }

    public function destroy(Testmodule $testmodule)
    {
        abort_if(Gate::denies('testmodule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testmodule->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestmoduleRequest $request)
    {
        Testmodule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
