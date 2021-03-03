<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDentalDetailsResource extends JsonResource
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
            'invoice_id' => $this->invoice_id,
            'appliance_placed' => $this->appliance_placed->format('M-d-Y'),
            'prior_placement' => $this->prior_placement->format('M-d-Y'),
            'accident' => $this->accident->format('M-d-Y'),
            'appliance_placed2' => $this->appliance_placed->format('Y-m-d'),
            'prior_placement2' => $this->prior_placement->format('Y-m-d'),
            'accident2' => $this->accident->format('Y-m-d'),
            'enclosures' => $this->enclosures,
            'orthodontics' => $this->orthodontics,
            'months_remaining' => $this->months_remaining,
            'prosthesis_replacement' => $this->prosthesis_replacement,
            'treatment_resulting_from' => $this->treatment_resulting_from,
            'treatment' => $this->treatment(),
            'auto_accident_state' => $this->auto_accident_state,
            'license' => $this->license,
            'tooth_numbers' => $this->tooth_numbers,
        ];
    }
}