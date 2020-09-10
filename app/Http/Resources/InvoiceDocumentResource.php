<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDocumentResource extends JsonResource
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
            'invoice_id' => $this->invoice_id,
            'name' => $this->name,
            'path' => $this->path.$this->name.'.pdf',
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->created_at->format('M-d-Y'),
        ];
    }
}