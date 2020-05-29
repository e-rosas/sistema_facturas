<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public $fillable = [
        'number',
        'comments',
        'status',
        'invoice_id',
        'claim',
        'date',
    ];
    public static $rules = [
        'comments' => 'max:1000',
        'status' => 'numeric',
        'invoice_id' => 'required',
        'date' => 'date',
        'claim' => 'max:255',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'comments' => 'string',
        'claim' => 'string',
    ];

    protected $dates = ['date'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return __('En proceso');

                break;
            case 1:
                return __('Deducibles');

                break;
            case 2:
                return __('Negada por cargos no cubiertos');

                break;
            case 3:
                return __('Pagada');

                break;
            case 4:
                return __('Negada por cobro no llenado');

                break;
            case 5:
                return __('Otro');

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
