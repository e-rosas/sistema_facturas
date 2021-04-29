<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InsuranceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'group_number' => $this->group_number,
            'insurance_id' => $this->insurance_id,
            'status' => $this->status(),
            'status2' => $this->status,
            'insurer_id' => $this->insurer_id,
            'insuree_id' => $this->insuree_id,
            'insurer' => $this->insurer->name,
            'insurer_group_phone_number' => $this->insurer_group_phone_number,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'type' => $this->type(),
            'type2' => $this->type,
            'active' => $this->status == 0 ? 'checked' : '',
        ];
    }
}
