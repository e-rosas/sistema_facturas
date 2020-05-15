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
        return $this->hasMany('App\InvoiceDiagnosisList', 'invoice_diagnoses_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function services()
    {
        return $this->hasMany('App\DiagnosisService', 'invoice_diagnoses_id', 'id');
    }
}
