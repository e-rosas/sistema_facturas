<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDentalDetails extends Model
{
    public $fillable = [
        'enclosures',
        'orthodontics',
        'appliance_placed',
        'months_remaining',
        'prosthesis_replacement',
        'treatment_resulting_from',
        'prior_placement',
        'accident',
        'auto_accident_state',
        'license',
    ];

    protected $casts = [
        'invoice_id' => 'integer',
        'enclosures' => 'boolean',
        'orthodontics' => 'boolean',
        'license' => 'string',
        'auto_accident_state' => 'string',
        'treatment_resulting_from' => 'integer',
        'months_remaining' => 'integer',
        'prosthesis_replacement' => 'boolean',
    ];
    protected $dates = [
        'appliance_placed',
        'created_at',
        'updated_at',
        'prior_placement',
        'accident', ];

    public function treatment()
    {
        switch ($this->treatment_resulting_from) {
            case 0:
                return 'Lesión / enfermedad ocupacional.';

                break;
            case 1:
                return 'Accidente automovilístico.';

                break;
            case 2:
                return 'Otro accidente.';

                break;
            case 3:
                return 'No aplica.';

                break;
            default:
                // code...
                break;
        }
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}