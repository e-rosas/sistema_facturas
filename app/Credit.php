<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public $fillable = [
        'amount_due',
        'series',
        'number',
        'comments',
        'exchange_rate',
        'date',
        'invoice_id',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function amountDue()
    {
        return number_format($this->amount_due, 4);
    }

    public function exchangeRate()
    {
        return number_format($this->exchange_rate, 4);
    }

    public function debe()
    {
        return $this->amount_due * $this->exchange_rate;
    }

    public function total()
    {
        $mxn = $this->amount_due * $this->exchange_rate;

        return number_format($mxn, 4);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function concept()
    {
        return 'Nota de crédito '.$this->date->year;
    }
}
