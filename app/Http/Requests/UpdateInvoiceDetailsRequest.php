<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceDetailsRequest extends FormRequest
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
            'date' => 'date',
            'DOS' => 'date',
            'comments' => 'max:1000',
            'doctor' => 'required|max:255',
            'exchange_rate' => 'numeric|required|between:0,999999999.999',
            'hospitalization' => 'boolean',
            'cash' => 'boolean',
        ];
    }
}