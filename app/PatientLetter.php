<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientLetter extends Model
{
    use HasFactory;
    public $fillable = [
        'patient_id',
        'date',
        'status',
        'content',
        'comments',
        'reply',
    ];
    protected $dates = ['date'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Enviado.';

                break;
            case 1:
                return 'Aseguranza contestó.';

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