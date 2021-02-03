<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insuree extends Model
{
    public $dependents;
    public $fillable = [
        'patient_id',
        'insurer_id',
        'insurance_id',
        'insurer_phone_number',
        'nss',
        'group_number',
    ];
    protected $primaryKey = 'patient_id';

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function insurer()
    {
        return $this->belongsTo('App\Insurer');
    }

    public function dependents()
    {
        return $this->hasMany('App\Dependent', 'insuree_id', 'patient_id');
    }

    public function fullName()
    {
        $data = $this->patient;

        return $data->full_name;
    }
}