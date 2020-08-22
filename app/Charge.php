<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    public $primaryKey = 'invoice_id';
    public $fillable = [
        'status',
        'comments',
        'date',
        'invoice_id',
        'number',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return __('Deducibles');

                break;
            case 1:
                return __('Negada por cargos no cubiertos');

                break;
            case 2:
                return __('Negada por fuera de tiempo');

                break;
            case 3:
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

    public function letters()
    {
        return $this->hasMany('App\Letter', 'charge_id', 'invoice_id');
    }

    public function concept()
    {
        return 'Cargo personal '.$this->date->year;
    }
}