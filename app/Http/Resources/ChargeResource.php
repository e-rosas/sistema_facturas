<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChargeResource extends JsonResource
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
            'original_amount_due' => $this->amount_due,
            'amount_charged' => $this->amount_due,
            'status' => $this->status(),
            'concept' => $this->concept(),
            'number' => $this->number,
            'exchange_rate' => $this->exchange_rate,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->date->format('d-m-Y'),
        ];
    }
}
