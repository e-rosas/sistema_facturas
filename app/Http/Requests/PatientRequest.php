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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => 'max:120',
            'maiden_name' => 'max:20',
            'name' => 'required|min:2|max:100',
            'full_name' => 'max:250',
            'birth_date' => 'date',
            'address' => 'max:255',
            'city' => 'max:255',
            'state' => 'max:255',
            'postal_code' => 'digits:5',
            'phone_number' => 'max:255',
            'email' => 'max:255',
            'insurance_id' => 'max:255',
            'insurer_id' => 'max:255',
        ];
    }
}
