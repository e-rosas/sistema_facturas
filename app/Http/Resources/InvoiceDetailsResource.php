<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetailsResource extends JsonResource
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
            'date' => $this->date->format('M-d-Y'),
            'DOS' => $this->DOS->format('M-d-Y'),
            'concept' => $this->concept,
            'number' => $this->number,
            'code' => $this->code,
            'series' => $this->series,
            'doctor' => $this->doctor,
            'exchange_rate' => $this->exchange_rate,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'cash' => $this->cash,
        ];
    }
}