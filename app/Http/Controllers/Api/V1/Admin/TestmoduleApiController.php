<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTestmoduleRequest;
use App\Http\Requests\UpdateTestmoduleRequest;
use App\Http\Resources\Admin\TestmoduleResource;
use App\Testmodule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestmoduleApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('testmodule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TestmoduleResource(Testmodule::with(['category', 'categoryxes'])->get());
    }

    public function store(StoreTestmoduleRequest $request)
    {
        $testmodule = Testmodule::create($request->all());
        $testmodule->categoryxes()->sync($request->input('categoryxes', []));

        if ($request->input('file_singlex', false)) {
            $testmodule->addMedia(storage_path('tmp/uploads/' . $request->input('file_singlex')))->toMediaCollection('file_singlex');
        }

        if ($request->input('file_multix', false)) {
            $testmodule->addMedia(storage_path('tmp/uploads/' . $request->input('file_multix')))->toMediaCollection('file_multix');
        }

        return (new TestmoduleResource($testmodule))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Testmodule $testmodule)
    {
        abort_if(Gate::denies('testmodule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TestmoduleResource($testmodule->load(['category', 'categoryxes']));
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

        if ($request->input('file_multix', false)) {
            if (!$testmodule->file_multix || $request->input('file_multix') !== $testmodule->file_multix->file_name) {
                $testmodule->addMedia(storage_path('tmp/uploads/' . $request->input('file_multix')))->toMediaCollection('file_multix');
            }
        } elseif ($testmodule->file_multix) {
            $testmodule->file_multix->delete();
        }

        return (new TestmoduleResource($testmodule))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Testmodule $testmodule)
    {
        abort_if(Gate::denies('testmodule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testmodule->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
