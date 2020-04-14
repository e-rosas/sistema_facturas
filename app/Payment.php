<?php

namespace App;

use App\Events\PaymentEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use Notifiable;
    public $fillable = [
        'amount_paid',
        'series',
        'number',
        'method',
        'comments',
        'exchange_rate',
        'concept',
        'date',
        'invoice_id',
    ];
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => PaymentEvent::class,
        'updated' => PaymentEvent::class,
        'deleted' => PaymentEvent::class,
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
    public function concept()
    {
        switch ($this->concept) {
            case 0:
                return 'Complemento de pago.';

                break;
            case 1:
                return 'Complemento de pago unico.';

                break;
            default:
                // code...
                break;
        }
    }
}
