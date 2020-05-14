<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDiagnosis extends Model
{
    public $primaryKey = 'invoice_id';
    public $fillable = [
        'invoice_id',
    ];

    public function diagnoses()
    {
        return $this->hasMany('App\InvoiceDiagnosisList', 'invoice_diagnoses_id', 'invoice_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'id', 'invoice_id');
    }
}
