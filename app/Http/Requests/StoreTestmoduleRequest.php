<?php

namespace App\Http\Requests;

use App\Testmodule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTestmoduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('testmodule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'textx'           => [
                'required',
                'unique:testmodules',
            ],
            'emailx'          => [
                'required',
            ],
            'integerx'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'floatx'          => [
                'min:1',
                'max:100',
            ],
            'datepickerx'     => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'datetimepickerx' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'timepickerx'     => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'categoryxes.*'   => [
                'integer',
            ],
            'categoryxes'     => [
                'array',
            ],
        ];
    }
}
