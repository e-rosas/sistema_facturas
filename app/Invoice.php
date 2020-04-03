<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $fillable = [
        'series',
        'number',
        'concept',
        'currency',
        'method',
        'comments',
        'status',
        'date',
        'IVA',
        'IVA_applied',
        'subtotal',
        'total',
        'exchange_rate',
        'amount_paid',
        'amount_due',
        'type',
        'patient_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'series' => 'string',
        'number' => 'string',
        'concept' => 'string',
        'currency' => 'string',
        'date' => 'date',
        'comments' => 'string',
        'status' => 'string',
        'IVA' => 'decimal:13',
        'IVA_applied' => 'decimal:13',
        'subtotal' => 'decimal:13',
        'total' => 'decimal:13',
        'exchange_rate' => 'decimal:13',
        'amount_paid' => 'decimal:13',
        'amount_due' => 'decimal:13',
        'type' => 'integer',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function getIVAAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getIVAAppliedAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getExchangeRateAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getSubtotalAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getTotalAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getAmountPaidAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getAmountDueAttribute($value)
    {
        return number_format($value, 4);
    }

    public function code()
    {
        return $this->series.$this->number;
    }

    public function type()
    {
        switch ($this->type) {
            case 0:
                return 'Con nota de credito.';

                break;
            case 1:
                return 'Un solo pago completo.';

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

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function credit()
    {
        return $this->hasOne('App\Credit');
    }
}
