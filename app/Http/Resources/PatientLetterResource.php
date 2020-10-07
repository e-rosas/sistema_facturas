<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientLetterResource extends JsonResource
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
            'status_n' => $this->status,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'reply' => $this->reply,
            'content' => $this->content,
            'date' => $this->date->format('M-d-y'),
            'date2' => $this->date->format('Y-m-d'),
        ];
    }
}