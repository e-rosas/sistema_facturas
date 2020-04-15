<?php

namespace App;

use App\Events\PatientCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use Notifiable;
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
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => PatientCreated::class,
    ];
    protected $dates = ['birth_date'];

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function insurer()
    {
        return $this->belongsTo('App\Insurer');
    }

    public function person_stats()
    {
        return $this->hasOne('App\PersonStats');
    }

    public function addressDetails()
    {
        return $this->city.', '.$this->state.'.  '.$this->postal_code;
    }
}
