<?php

namespace App\Http\Requests;

use App\Option;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreOptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('option_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'question_id' => [
                'required',
                'integer',
            ],
            'option_text' => [
                'required',
            ],
            'points'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
