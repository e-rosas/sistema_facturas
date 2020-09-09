<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientDocumentResource extends JsonResource
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
            'patient_id' => $this->patient_id,
            'name' => $this->name,
            'type' => $this->type(),
            'type2' => $this->type,
            'path' => $this->path,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->created_at->format('M-d-Y'),
        ];
    }
}