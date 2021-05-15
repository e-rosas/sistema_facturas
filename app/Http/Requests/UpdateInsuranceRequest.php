<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInsuranceRequest extends FormRequest
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
            'group_number' => 'max:50',
            'insurance_id' => 'required',
            'group_phone_number' => 'max:250',
            'insurer_id' => 'required',
            'insuree_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'comments' => 'max:900',
            'id' => 'required'
        ];
    }
}
