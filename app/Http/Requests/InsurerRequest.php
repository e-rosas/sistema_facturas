<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsurerRequest extends FormRequest
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
            'name' => 'required|min:5|max:255',
            'code' => 'required|min:1|max:255',
            'address' => 'max:255',
            'city' => 'max:255',
            'state' => 'max:255',
            'postal_code' => 'digits:5',
            'phone_number' => 'max:255',
            'email' => 'email',
        ];
    }
}
