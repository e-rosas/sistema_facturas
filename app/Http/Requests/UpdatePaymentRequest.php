<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'payment_id' => 'required',
            'amount_paid' => 'required|numeric|between:0,999999999.999',
            'exchange_rate' => 'numeric|required|between:0,999999999.999',
            'comments' => 'max:1000',
            'method' => 'max:255',
            'number' => 'max:255',
            'date' => 'date',
        ];
    }
}
