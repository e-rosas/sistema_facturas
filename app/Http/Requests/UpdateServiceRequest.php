<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'code' => 'required|max:255',
            'description' => 'max:255',
            'descripcion' => 'max:255',
            'price' => 'numeric|required|between:0,999999999.999',
            'discounted_price' => 'numeric|required|between:0,999999999.999',
            'category_id' => 'required|numeric',
            'SAT' => 'max:255',
            'SAT_code' => 'max:255',
        ];
    }
}
