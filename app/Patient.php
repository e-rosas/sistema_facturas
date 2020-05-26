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
        'name',
        'full_name',
        'birth_date',
        'street',
        'street_number',
        'city',
        'state',
        'zip_code',
        'phone_number',
        'gender',
        'status',
        'occupation',
        'email',
        'insured',
        'deductible',
    ];
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => PatientCreated::class,
    ];
    protected $dates = ['birth_date'];

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function person_stats()
    {
        return $this->hasOne('App\PersonStats');
    }

    public function insuree()
    {
        return $this->hasOne('App\Insuree', 'patient_id', 'id');
    }

    public function dependent()
    {
        return $this->hasOne('App\Dependent', 'patient_id', 'id');
    }

    public function gender()
    {
        switch ($this->gender) {
            case 0:
                return 'Masculino';

                break;
            case 1:
                return 'Femenino';

                break;
            default:
                // code...
                break;
        }
    }

    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Otro';

                break;
            case 1:
                return 'Casado';

                break;
            case 2:
                return 'Soltero';

                break;
            default:
                // code...
                break;
        }
    }

    public function occupation()
    {
        switch ($this->occupation) {
            case 0:
                return 'Otro';

                break;
            case 1:
                return 'Empleado';

                break;
            case 2:
                return 'Estudiante';

                break;
            case 3:
                return 'Estudiante tiempo parcial';

                break;
            default:
                // code...
                break;
        }
    }

    public function address()
    {
        return $this->street_number.' '.$this->street;
    }

    public function addressDetails()
    {
        return $this->city.', '.$this->state.'.  '.$this->zip_code;
    }

    public function name()
    {
        return $this->last_name.','.$this->name;
    }
}
