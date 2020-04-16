<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditRequest extends FormRequest
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
            'series' => 'max:250',
            'date' => 'date',
            'invoice_id' => 'required',
            'invoice_number' => 'required',
            'exchange_rate' => 'numeric|required|between:0,99.999',
        ];
    }
}
