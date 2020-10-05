<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientLetter extends Model
{
    use HasFactory;
    public $fillable = [
        'patient_id',
        'sent_on',
        'comments',
    ];
    protected $dates = ['sent_on'];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}