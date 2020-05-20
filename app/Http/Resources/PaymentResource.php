<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'invoice' => $this->invoice->code,
            'amount_paid' => $this->amountPaid(),
            'number' => $this->number,
            'method' => $this->method(),
            'concept' => $this->concept(),
            'exchange_rate' => $this->exchangeRate(),
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->date->format('d-m-Y'),
            'date2' => $this->date->format('Y-m-d'),
        ];
    }
}
