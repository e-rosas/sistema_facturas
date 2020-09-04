<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDentalService extends Model
{
    public $fillable = [
        'oral_cavity',
        'tooth_system',
        'tooth_numbers',
        'tooth_surfaces',
    ];

    protected $casts = [
        'diagnosis_service_id' => 'integer',
        'oral_cavity' => 'string',
        'tooth_system' => 'string',
        'tooth_numbers' => 'string',
        'tooth_surfaces' => 'string',
    ];

    public function service()
    {
        return $this->belongsTo('App\DiagnosisService');
    }
}