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
            'first_line' => 'max:38|required',
            'second_line' => 'max:38|required',
            'phone_number' => 'max:12',
            'third_line' => 'max:38',
            'fourth_line' => 'max:38|required',
            'default' => 'boolean',
        ];
    }
}