@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.testpost.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testpost.fields.id') }}
                        </th>
                        <td>
                            {{ $testpost->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testpost.fields.title') }}
                        </th>
                        <td>
                            {{ $testpost->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testpost.fields.slug') }}
                        </th>
                        <td>
                            {{ $testpost->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testpost.fields.category') }}
                        </th>
                        <td>
                            {{ $testpost->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Xcaregory
                        </th>
                        <td>
                            @foreach($testpost->xcaregories as $id => $xcaregory)
                                <span class="label label-info label-many">{{ $xcaregory->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection