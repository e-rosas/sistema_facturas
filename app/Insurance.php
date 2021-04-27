<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    public $fillable = [
        'group_number',
        'insurance_id',
        'active',
        'active_since',
        'active_until',
        'insurer_group_phone_number'
    ];
    public function insuree()
    {
        return $this->belongsTo('App\Insuree', 'insuree_id', 'patient_id');
    }
    public function insurer()
    {
        return $this->belongsTo('App\Model\Insurer', 'insurer_id');
    }
}
