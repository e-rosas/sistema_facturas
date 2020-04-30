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

    public function getAmountDueAttribute($value)
    {
        return number_format($value, 4);
    }

    public function total()
    {
        $mxn = (float) str_replace(',', '', $this->amount_due) * (float) str_replace(',', '', $this->exchange_rate);

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
