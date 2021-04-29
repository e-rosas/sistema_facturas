<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'series' => 'max:255',
            'number' => 'max:255',
            'doctor' => 'required|max:255',
            'code' => 'max:255|unique:invoices,code',
            'concept' => 'max:255',
            'currency' => 'max:255',
            'date' => 'date',
            'DOS' => 'date',
            'comments' => 'max:1000',
            'tax' => 'numeric|required|between:0,999999999.999',
            'dtax' => 'numeric|required|between:0,999999999.999',
            'sub_total' => 'numeric|required|between:0,999999999.999',
            'sub_total_discounted' => 'numeric|required|between:0,999999999.999',
            'total' => 'numeric|required|between:0,999999999.999',
            'total_with_discounts' => 'numeric|required|between:0,999999999.999',
            'amount_paid' => 'numeric|between:0,999999999.999',
            'amount_due' => 'numeric|between:0,999999999.999',
            'patient_id' => 'required',
            'exchange_rate' => 'numeric|required|between:0,999999999.999',
            'hospitalization' => 'boolean',
            'registered' => 'boolean',
            'dental' => 'boolean',
            'accept_assignment' => 'boolean',
        ];
    }
}