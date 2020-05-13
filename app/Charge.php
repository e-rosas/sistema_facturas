<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    public $fillable = [
        'original_amount_due',
        'amount_charged',
        'status',
        'comments',
        'exchange_rate',
        'date',
        'invoice_id',
        'number',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Transferencia.';

                break;
            case 1:
                return 'Cheque.';

                break;
            default:
                // code...
                break;
        }
    }

    public function getAmountCharged()
    {
        return number_format($this->amount_charged, 4);
    }

    public function getOriginalAmountDue()
    {
        return number_format($this->original_amount_due, 4);
    }

    public function getExchangeRate()
    {
        return number_format($this->exchange_rate, 4);
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
