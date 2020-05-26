<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceStatsResource extends JsonResource
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
        $amount_dueMXN = (5 == $this->status ? $this->chargeAmountDueMXN() : $this->debeF());
        $amount_due = (5 == $this->status ? $this->chargeAmountDue() : $this->amountDue());

        return [
            'id' => $this->id,
            'status' => $this->status(),
            'type' => $this->type(),
            'amount_paid' => $this->amountPaid(),
            'amount_due' => $amount_due,
            'status_n' => $this->status,
            'type_n' => $this->type,
            'amount_paidMXN' => $this->amountPaidMXN(),
            'amount_dueMXN' => $amount_dueMXN,
        ];
    }
}
