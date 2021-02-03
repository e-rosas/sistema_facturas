<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
        return [
            'full_name' => 'max:250',
            'birth_date' => 'date',
            'status' => 'max:255',
            'gender' => 'max:255',
            'occupation' => 'max:255',
            'street' => 'max:255',
            'zip_code' => 'required',
            'street_number' => 'max:255',
            'city' => 'max:255',
            'state' => 'max:255',
            'phone_number' => 'max:255',
            'insurer_phone_number' => 'max:255',
            'email' => 'max:255',
            'insured' => 'boolean',
            'deductible' => 'numeric',
            'last_name' => 'required|max:80',
            'name' => 'required|min:2|max:100',
            'insurer_id' => 'numeric',
            'insurance_id' => 'max:50',
            'group_number' => 'max:20',
            'insuree_id' => 'max:10',
            'relationship' => 'max:10',
        ];
    }
}