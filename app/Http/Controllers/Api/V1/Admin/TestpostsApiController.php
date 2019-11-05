<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestpostRequest;
use App\Http\Requests\UpdateTestpostRequest;
use App\Http\Resources\Admin\TestpostResource;
use App\Testpost;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestpostsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('testpost_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TestpostResource(Testpost::with(['category', 'xcaregories'])->get());
    }

    public function store(StoreTestpostRequest $request)
    {
        $testpost = Testpost::create($request->all());
        $testpost->xcaregories()->sync($request->input('xcaregories', []));

        return (new TestpostResource($testpost))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Testpost $testpost)
    {
        abort_if(Gate::denies('testpost_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TestpostResource($testpost->load(['category', 'xcaregories']));
    }

    public function update(UpdateTestpostRequest $request, Testpost $testpost)
    {
        $testpost->update($request->all());
        $testpost->xcaregories()->sync($request->input('xcaregories', []));

        return (new TestpostResource($testpost))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Testpost $testpost)
    {
        abort_if(Gate::denies('testpost_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testpost->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
