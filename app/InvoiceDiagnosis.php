<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDiagnosis extends Model
{
    public $fillable = [
        'invoice_id',
    ];

    public function diagnoses()
    {
        return $this->hasMany('App\InvoiceDiagnosisList');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
