<?php

namespace App;

use App\Events\InvoiceEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
    use Notifiable;
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => InvoiceEvent::class,/* 
        'updated' => InvoiceEvent::class,
        'deleted' => InvoiceEvent::class, */
    ];
    public $fillable = [
        'series',
        'number',
        'code',
        'concept',
        'currency',
        'method',
        'comments',
        'status',
        'date',
        'tax',
        'dtax',
        'sub_total',
        'sub_total_discounted',
        'total',
        'total_with_discounts',
        'amount_paid',
        'amount_due',
        'exchange_rate',
        'type',
        'patient_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'series' => 'string',
        'number' => 'string',
        'code' => 'string',
        'concept' => 'string',
        'currency' => 'string',
        'date' => 'date',
        'comments' => 'string',
        'status' => 'string',
        'tax' => 'decimal:13',
        'dtax' => 'decimal:13',
        'sub_total' => 'decimal:13',
        'total' => 'decimal:13',
        'exchange_rate' => 'decimal:13',
        'amount_paid' => 'decimal:13',
        'amount_due' => 'decimal:13',
        'type' => 'integer',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function getTaxAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getDtaxAttribute($value)
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
            case 2:
                return 'Pendiente de pago';

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
                return 'Complemento de pago pendiente.';

                break;
            case 1:
                return 'Un solo pago completo.';

                break;
            case 2:
                return 'Pendiente de pago.';

                break;
            case 3:
                return 'Pendiente de asignar articulos.';

                break;
            case 4:
                return 'Pendiente de facturar.';

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

    public function services()
    {
        return $this->hasMany('App\InvoiceService');
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
