<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDiagnosesResource extends JsonResource
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
            'date' => $this->date->format('Y-m-d'),
            'doctor' => $this->doctor,
            'exchange_rate' => $this->exchange_rate,
            'diagnoses' => InvoiceDiagnosisResource::collection($this->diagnoses),
            'patient' => new PatientDetailsResource($this->patient),
        ];
    }
}
