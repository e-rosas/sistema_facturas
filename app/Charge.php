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
                return __('Deductibles');

                break;
            case 1:
                return __('Denied for non covered charges');

                break;
            case 2:
                return __('Denied for untimely filing');

                break;
            case 3:
                return __('Other');

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