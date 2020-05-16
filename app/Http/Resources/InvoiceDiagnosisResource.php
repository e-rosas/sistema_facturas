<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDiagnosisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'diagnosis_id' => $this->diagnosis_id,
            'diagnosis_code' => $this->diagnosis_code,
            'diagnosis_name' => $this->diagnosis->name,
            'diagnosis_nombre' => $this->diagnosis->nombre,
        ];
    }
}
