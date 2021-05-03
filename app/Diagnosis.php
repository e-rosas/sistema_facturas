<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    public $fillable = [
        'code',
        'name',
        'nombre',
    ];
    /**
     * Get all of the invoices for the Diagnosis
     *
     * 
     */
    public function invoices()
    {
        return $this->belongsToMany('App\Invoice', 'invoice_diagnoses');
    }
    
}
