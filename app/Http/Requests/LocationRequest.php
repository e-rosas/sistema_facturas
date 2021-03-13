<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'name' => 'max:100|required',
            'first_line' => 'max:43|required',
            'second_line' => 'max:43|required',
            'phone_number' => 'max:25',
            'third_line' => 'max:43',
            'fourth_line' => 'max:43',
            'default' => 'boolean',
            'billing_first_line' => 'max:43|required',
            'billing_second_line' => 'max:43|required',
            'billing_third_line' => 'max:43',
            'billing_fourth_line' => 'max:43',
        ];
    }
}