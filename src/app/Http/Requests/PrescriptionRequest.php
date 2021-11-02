<?php

namespace App\Http\Requests;

class PrescriptionRequest extends Base
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'clinic.id'     => ['required', 'integer'],
            'physician.id'  => ['required', 'integer'],
            'patient.id'    => ['required', 'integer'],
            'text'          => ['required', 'string'],
        ];

        return $rules;
    }
}
