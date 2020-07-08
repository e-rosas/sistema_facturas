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
            'status' => $this->status(),
            'concept' => $this->concept(),
            'number' => $this->number,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->date->format('d-m-Y'),
        ];
    }
}