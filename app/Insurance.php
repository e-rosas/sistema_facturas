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
        'comments',
        'type',
        'status',
        'group_phone_number',
        'insuree_id',
        'insurer_id'
    ];
    public function insuree()
    {
        return $this->belongsTo('App\Insuree', 'insuree_id', 'patient_id');
    }
    public function insurer()
    {
        return $this->belongsTo('App\Insurer');
    }
    public function type()
    {
        switch ($this->type) {
            case 0:
                return 'Médica.';

                break;
            case 1:
                return 'Dental.';

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
                return 'Activa.';

                break;
            case 1:
                return 'Vencida.';

                break;
            default:
                // code...
                break;
        }
    }
}
