<?php

namespace App\Http\Requests;

use App\Xcategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyXcategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('xcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:xcategories,id',
        ];
    }
}
