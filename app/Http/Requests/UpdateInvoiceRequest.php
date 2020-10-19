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
            'tax' => 'numeric|required|between:0,999999999.999',
            'dtax' => 'numeric|required|between:0,999999999.999',
            'sub_total' => 'numeric|required|between:0,999999999.999',
            'sub_total_discounted' => 'numeric|required|between:0,999999999.999',
            'total' => 'numeric|required|between:0,999999999.999',
            'total_with_discounts' => 'numeric|required|between:0,999999999.999',
            'dental' => 'boolean',
        ];
    }
}