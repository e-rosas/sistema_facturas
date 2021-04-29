<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insuree extends Model
{
    public $dependents;
    public $insurance;
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

    public function insurances()
    {
        return $this->hasMany('App\Insurance', 'insuree_id', 'patient_id');
    }

    public function insurance()
    {
        if(!$this->insurance){
            $this->insurance = Insurance::where('insuree_id', $this->patient_id)->where('status', 0)->first();
        }
        return $this->insurance;
    }

    public function fullName()
    {
        $data = $this->patient;

        return $data->full_name;
    }
}