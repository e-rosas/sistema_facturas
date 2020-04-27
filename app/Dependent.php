<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    public $fillable = [
        'patient_id',
        'insuree_id',
        'relationship',
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function insuree()
    {
        return $this->belongsTo('App\Insuree');
    }
}
