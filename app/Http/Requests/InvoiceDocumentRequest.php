<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceDocumentRequest extends FormRequest
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
            'invoice_code' => 'required',
            'patient_id' => 'required',
            'file' => 'required|mimes:pdf',
            'name' => 'required|max:200',
            'comments' => 'max:1000',
        ];
    }
}