<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditResource extends JsonResource
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
            'amount_due' => $this->amountDue(),
            'number' => $this->number,
            'concept' => $this->concept(),
            'exchange_rate' => $this->exchangeRate(),
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->date->format('d-m-Y'),
        ];
    }
}