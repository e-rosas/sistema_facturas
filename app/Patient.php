<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $fillable = [
        'last_name',
        'maiden_name',
        'name',
        'full_name',
        'birth_date',
        'address',
        'city',
        'state',
        'postal_code',
        'phone_number',
        'email',
        'insurance_id',
        'insurer_id',
    ];
    protected $dates = ['birth_date'];

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function addressDetails()
    {
        return $this->city.', '.$this->state.'.  '.$this->postal_code;
    }
}
