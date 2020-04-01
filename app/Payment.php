<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $fillable = [
        'amount_paid',
        'series',
        'number',
        'comments',
        'exchange_rate',
        'concept',
        'date',
        'invoice_id',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function getAmountPaidAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getExchangeRateAttribute($value)
    {
        return number_format($value, 4);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
