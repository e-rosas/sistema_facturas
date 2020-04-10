<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonStatsResource extends JsonResource
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
            'person_data_id' => $this->person_data_id,
            'amount_paid' => $this->getAmount_paid(),
            'total_amount_due' => $this->getTotal(),
            'status' => $this->status,
            'amount_due' => $this->getAmount_due(),
            'personal_amount_due' => $this->getPersonalAmountDue(),
            'total_total' => $this->getTotalAmountDue()
        ];
    }
}
