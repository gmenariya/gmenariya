@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.testmodule.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.id') }}
                        </th>
                        <td>
                            {{ $testmodule->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.textx') }}
                        </th>
                        <td>
                            {{ $testmodule->textx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.emailx') }}
                        </th>
                        <td>
                            {{ $testmodule->emailx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.textareack') }}
                        </th>
                        <td>
                            {!! $testmodule->textareack !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.tetareanock') }}
                        </th>
                        <td>
                            {!! $testmodule->tetareanock !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.passwordx') }}
                        </th>
                        <td>
                            ---
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.radiox') }}
                        </th>
                        <td>
                            {{ App\Testmodule::RADIOX_RADIO[$testmodule->radiox] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.selectx') }}
                        </th>
                        <td>
                            {{ App\Testmodule::SELECTX_SELECT[$testmodule->selectx] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.checkboxx') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $testmodule->checkboxx ? "checked" : "" }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.integerx') }}
                        </th>
                        <td>
                            {{ $testmodule->integerx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.floatx') }}
                        </th>
                        <td>
                            {{ $testmodule->floatx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.moneyx') }}
                        </th>
                        <td>
                            ${{ $testmodule->moneyx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.datepickerx') }}
                        </th>
                        <td>
                            {{ $testmodule->datepickerx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.datetimepickerx') }}
                        </th>
                        <td>
                            {{ $testmodule->datetimepickerx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.timepickerx') }}
                        </th>
                        <td>
                            {{ $testmodule->timepickerx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.file_singlex') }}
                        </th>
                        <td>
                            {{ $testmodule->file_singlex }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.file_multix') }}
                        </th>
                        <td>
                            {{ $testmodule->file_multix }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testmodule.fields.category') }}
                        </th>
                        <td>
                            {{ $testmodule->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Categoryx
                        </th>
                        <td>
                            @foreach($testmodule->categoryxes as $id => $categoryx)
                                <span class="label label-info label-many">{{ $categoryx->name }}</span>
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