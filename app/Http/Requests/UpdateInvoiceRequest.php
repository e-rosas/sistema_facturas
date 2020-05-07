<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
            'invoice_id' => 'required',
            'series' => 'max:255',
            'number' => 'max:255',
            'code' => 'required|max:255',
            'concept' => 'max:255',
            'doctor' => 'max:255',
            'currency' => 'max:255',
            'date' => 'date',
            'comments' => 'max:1000',
            'tax' => 'numeric|required|between:0,999999999.999',
            'dtax' => 'numeric|required|between:0,999999999.999',
            'sub_total' => 'numeric|required|between:0,999999999.999',
            'sub_total_discounted' => 'numeric|required|between:0,999999999.999',
            'total' => 'numeric|required|between:0,999999999.999',
            'total_with_discounts' => 'numeric|required|between:0,999999999.999',
            'patient_id' => 'required',
            'exchange_rate' => 'numeric|required|between:0,999999999.999',
        ];
    }
}
