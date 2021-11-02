<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Base extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    protected function failedValidation(Validator $validator) {

        $message = [
            'success' => false,
            'error' => $validator->errors()->getMessages()
        ];

        throw new HttpResponseException(response()->json($message, 422));
    }
}
