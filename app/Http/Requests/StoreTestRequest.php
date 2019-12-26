<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'questions'     => [
                'required', 'array'
            ],
            'questions.*' => [
                'required', 'integer', 'exists:options,id'
            ],
        ];
    }
}
