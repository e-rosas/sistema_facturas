<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDiagnosis extends Model
{
    public $fillable = [
        'invoice_id',
        'diagnosis_id',
        'diagnosis_code',
    ];

    public function diagnosis()
    {
        return $this->belongsTo('App\Diagnosis');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
