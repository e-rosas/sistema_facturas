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
            'amount_paid' => $this->amount,
            'number' => $this->number,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->date->format('Y-m-d'),
            'date_service' => $this->date_service->format('Y-m-d'),
        ];
    }
}
