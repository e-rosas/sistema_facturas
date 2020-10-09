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
    protected $primaryKey = 'patient_id';

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function insuree()
    {
        return $this->belongsTo('App\Insuree', 'insuree_id', 'patient_id');
    }

    public function relationship()
    {
        switch ($this->relationship) {
            case 0:
                return 'Otro.';

                break;
            case 1:
                return 'Hijo(a).';

                break;
            case 2:
                return 'Esposo(a)';

                break;
            case 3:
                return 'Pendiente';

                break;
            default:
                // code...
                break;
        }
    }
}