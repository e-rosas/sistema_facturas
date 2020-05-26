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
            'amount_paidMXN' => $this->amountPaidMXN($this->exchange_rate),
            'number' => $this->number,
            'method' => $this->method(),
            'method2' => $this->method,
            'concept' => $this->concept(),
            'exchange_rate' => $this->exchangeRate(),
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->date->format('d-m-Y'),
            'date2' => $this->date->format('Y-m-d'),
            'type' => $this->type(),
            'type2' => $this->type,
        ];
    }
}
