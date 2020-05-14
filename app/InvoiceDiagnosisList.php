<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDiagnosisList extends Model
{
    public $fillable = [
        'diagnosis_id',
        'invoice_diagnoses_id',
        'diagnosis_code',
    ];

    public function diagnosis()
    {
        return $this->belongsTo('App\Diagnosis');
    }

    public function invoiceDiagnosis()
    {
        return $this->belongsTo('App\InvoiceDiagnosis', 'invoice_id', 'invoice_diagnoses_id');
    }

    public function services()
    {
        return $this->hasMany('App\DiagnosisService');
    }
}
