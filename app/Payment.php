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
        'number',
        'method',
        'comments',
        'exchange_rate',
        'date',
        'invoice_id',
    ];
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => PaymentEvent::class,
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

    public function method()
    {
        switch ($this->method) {
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

    public function concept()
    {
        switch ($this->concept) {
            case 0:
                return 'Complemento de pago.';

                break;
            case 1:
                return 'Complemento de pago único.';

                break;
            default:
                // code...
                break;
        }
    }
}
