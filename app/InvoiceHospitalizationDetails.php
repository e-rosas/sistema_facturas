<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHospitalizationDetails extends Model
{
    use HasFactory;
    protected $primaryKey = 'invoice_id';

    public $fillable = [
        'bill_type',
        'diagnosis_codes',
        'breakdown',
    ];
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
