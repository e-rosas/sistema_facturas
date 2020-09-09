<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDocument extends Model
{
    public $fillable = [
        'patient_id',
        'name',
        'path',
        'type',
        'comments',
    ];

    public function type()
    {
        switch ($this->type) {
            case 0:
                return 'Otros.';

                break;
            case 1:
                return 'Beneficios.';

                break;
            default:
                // code...
                break;
        }
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}