<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    public $fillable = [
        'name',
        'code',
        'address',
        'city',
        'state',
        'postal_code',
        'phone_number',
        'email',
    ];

    public function addressDetails()
    {
        return $this->city.', '.$this->state.'.  '.$this->postal_code;
    }

    public function insurees()
    {
        return $this->hasMany('App\Insuree');
    }
}
