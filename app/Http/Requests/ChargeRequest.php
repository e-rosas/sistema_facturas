<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
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
            'comments' => 'max:1000',
            'date' => 'date',
            'invoice_id' => 'required',
            'number' => 'max:250',
            'invoice_number' => 'required',
            'status' => 'required',
        ];
    }
}