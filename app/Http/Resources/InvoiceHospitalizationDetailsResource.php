<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceHospitalizationDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'invoice_id' => $this->invoice_id,
            'bill_type' => $this->bill_type,
            'diagnosis_codes' => $this->diagnosis_codes,
            'breakdown' => $this->breakdown,
        ]
    }
}
