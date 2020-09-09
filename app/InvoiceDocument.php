<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDocument extends Model
{
    public $fillable = [
        'invoice_id',
        'name',
        'path',
        'comments',
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}