<?php

namespace App;

use App\Events\InvoiceEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
    use Notifiable;
    public $person;
    public $pagos = [];
    public $nota;
    public $fillable = [
        'series',
        'number',
        'code',
        'concept',
        'currency',
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
        'DOS',
        'doctor',
    ];
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => InvoiceEvent::class,
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

    protected $dates = ['date', 'created_at', 'updated_at', 'DOS'];

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

    public function getTotalWithDiscountsAttribute($value)
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

    public function subtotal()
    {
        $mxn = (float) str_replace(',', '', $this->sub_total_discounted) * (float) str_replace(',', '', $this->exchange_rate);

        return number_format($mxn, 4);
    }

    public function IVA()
    {
        $mxn = (float) str_replace(',', '', $this->dtax) * (float) str_replace(',', '', $this->exchange_rate);

        return number_format($mxn, 4);
    }

    public function total()
    {
        $mxn = (float) str_replace(',', '', $this->total_with_discounts) * (float) str_replace(',', '', $this->exchange_rate);

        return number_format($mxn, 4);
    }

    public function debe()
    {
        $mxn = (float) str_replace(',', '', $this->amount_due) * (float) str_replace(',', '', $this->exchange_rate);

        return number_format($mxn, 4);
    }

    public function type()
    {
        switch ($this->type) {
            case 0:
                return 'Crédito.';

                break;
            case 1:
                return 'Contado.';

                break;
            case 2:
                return 'Pendiente de pago.';

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
                return 'Nota de crédito pendiente.';

                break;
            case 1:
                return 'Completada.';

                break;
            case 2:
                return 'Pendiente de pago.';

                break;
            case 3:
                return 'Pendiente de asignar productos.';

                break;
            case 4:
                return 'Pendiente de facturar.';

                break;
            case 5:
                return 'Aseguranza no pagará.';

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

    public function calls()
    {
        return $this->hasMany('App\Call');
    }

    public function credit()
    {
        return $this->hasOne('App\Credit');
    }
}
