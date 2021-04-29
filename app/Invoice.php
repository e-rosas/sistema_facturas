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
        'amount_credit',
        'exchange_rate',
        'type',
        'patient_id',
        'DOS',
        'doctor',
        'hospitalization',
        'registered',
        'dental',
        'cash',
        'accept_assignment',
        'insurance_id'
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
        'amount_credit' => 'decimal:13',
        'type' => 'integer',
        'registered' => 'boolean',
        'accept_assignment' => 'boolean',
    ];

    protected $dates = ['date', 'created_at', 'updated_at', 'DOS'];

    public function subtotalDiscounted()
    {
        return number_format($this->sub_total_discounted, 4);
    }

    public function totalDiscounted()
    {
        return number_format($this->total_with_discounts, 4);
    }

    public function discountedTax()
    {
        return number_format($this->dtax, 4);
    }

    public function amountDue()
    {
        return number_format($this->amount_due, 4);
    }

    public function amountPaid()
    {
        return number_format($this->amount_paid, 4);
    }

    public function amountCredit()
    {
        return number_format($this->amount_credit, 4);
    }

    public function amountCreditMXN()
    {
        $mxn = $this->amount_credit * $this->exchange_rate;

        return number_format($mxn, 4);
    }

    public function amountPaidMXN()
    {
        $mxn = $this->amount_paid * $this->exchange_rate;

        return number_format($mxn, 4);
    }

    public function exchangeRate()
    {
        return number_format($this->exchange_rate, 4);
    }

    public function code()
    {
        return $this->series.$this->number;
    }

    public function subtotalF()
    {
        $mxn = $this->sub_total_discounted * $this->exchange_rate;

        return number_format($mxn, 4);
    }

    public function subtotal()
    {
        return $this->sub_total_discounted * $this->exchange_rate;
    }

    public function IVAF()
    {
        $mxn = $this->dtax * $this->exchange_rate;

        return number_format($mxn, 4);
    }

    public function IVA()
    {
        return $this->dtax * $this->exchange_rate;
    }

    public function totalF()
    {
        $mxn = $this->total_with_discounts * $this->exchange_rate;

        return number_format($mxn, 4);
    }

    public function total()
    {
        return $this->total_with_discounts * $this->exchange_rate;
    }

    public function totalDiscountedMXN()
    {
        return number_format($this->total_with_discounts * $this->exchange_rate, 4);
    }

    public function debeF()
    {
        $mxn = $this->amount_due * $this->exchange_rate;

        return number_format($mxn, 4);
    }

    public function debe()
    {
        return $this->amount_due * $this->exchange_rate;
    }

    public function pago()
    {
        return $this->amount_paid * $this->exchange_rate;
    }

    public function chargeAmountDueF()
    {
        $charge_due = $this->charge->amount_charged - $this->amount_paid;

        return number_format($charge_due, 4);
    }

    public function chargeAmountDueMXN()
    {
        $charge_due = $this->charge->amount_charged - $this->amount_paid;

        return number_format($charge_due * $this->exchange_rate, 4);
    }

    public function chargeAmountDue()
    {
        return $this->charge->amount_charged - $this->amount_paid;
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

            case 3:
                return 'Cargo al paciente.';

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
                return 'Completa.';

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
                return 'Pendiente de revisar.';

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

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function insurance()
    {
        return $this->belongsTo('App\Insurance');
    }

    public function insured()
    {
        if ($this->patient->insured) {
            return $this->patient;
        }

        $beneficiary = Dependent::where('patient_id', $this->patient_id)->first();

        return Patient::where('id', $beneficiary->insuree_id)->first();
    }

    public function services()
    {
        //DO NOT USE
        return $this->hasMany('App\InvoiceService');
    }

    public function diagnoses()
    {
        return $this->hasMany('App\InvoiceDiagnosis');
    }

    public function services2()
    {
        return $this->hasMany('App\DiagnosisService');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function calls()
    {
        return $this->hasMany('App\Call');
    }

    public function documents()
    {
        return $this->hasMany('App\InvoiceDocument');
    }

    public function credit()
    {
        return $this->hasOne('App\Credit');
    }

    public function charge()
    {
        return $this->hasOne('App\Charge');
    }

    public function dental_details()
    {
        return $this->hasOne('App\InvoiceDentalDetails');
    }
    public function hospitalization_details()
    {
        return $this->hasOne('App\InvoiceHospitalizationDetails');
    }
}