<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    public $fillable = [
        'comments',
        'campaign_id',
        'insurance_id',
        'date',
        'user_id',
        'patient_id'
    ];
    protected $dates = ['date'];

    public function insurance()
    {
        return $this->belongsTo('App\Insurance');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}