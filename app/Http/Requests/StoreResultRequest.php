<?php

namespace App\Http\Requests;

use App\Result;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreResultRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('result_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'user_id'      => [
                'required',
                'integer',
            ],
            'total_points' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'questions.*'  => [
                'integer',
            ],
            'questions'    => [
                'array',
            ],
        ];
    }
}
