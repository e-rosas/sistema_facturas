<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosisRequest extends FormRequest
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
            'code' => 'required|max:10|unique:diagnoses',
            'name' => 'max:250',
            'nombre' => 'max:250',
        ];
    }
}
