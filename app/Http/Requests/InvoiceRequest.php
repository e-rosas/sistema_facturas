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
            'series' => 'max:255',
            'number' => 'max:255',
            'code' => 'required|max:255',
            'status' => 'max:255',
            'concept' => 'max:255',
            'currency' => 'max:255',
            'method' => 'max:255',
            'date' => 'date',
            'comments' => 'max:1000',
            'IVA' => 'numeric|required|between:0,99.99',
            'IVA_applied' => 'numeric|required|between:0,999999999.999',
            'subtotal' => 'numeric|required|between:0,999999999.999',
            'exchange_rate' => 'numeric|required|between:0,999999999.999',
            'total' => 'numeric|required|between:0,999999999.999',
            'amount_paid' => 'numeric|between:0,999999999.999',
            'amount_due' => 'numeric|between:0,999999999.999',
            'patient_id' => 'required',
        ];
    }
}
