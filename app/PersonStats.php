<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonStats extends Model
{
    public $primaryKey = 'patient_id';
    public $fillable = [
        'status',
        'amount_paid',
        'amount_due',
        'amount_credit',
        'amount_credit_mxn',
        'amount_paid_mxn',
        'amount_due_mxn',
        'patient_id',
    ];
    protected $casts = [
        'patient_id' => 'integer',
        'status' => 'integer',
        'amount_paid' => 'decimal:13',
        'amount_due' => 'decimal:13',
        'amount_credit' => 'decimal:13',
        'amount_paid_mxn' => 'decimal:13',
        'amount_due_mxn' => 'decimal:13',
        'amount_credit_mxn' => 'decimal:13',
    ];

    /**
     * Get the value of amount_due.
     */
    public function amountDue()
    {
        return number_format($this->amount_due, 4);
    }

    public function amountDueMXN()
    {
        return number_format($this->amount_due_mxn, 4);
    }

    /* public function totalAmountDue()
    {
        return number_format($this->total_amount_due, 4);
    } */

    /**
     * Get the value of amount_paid.
     */
    public function amountPaid()
    {
        return number_format($this->amount_paid, 4);
    }

    public function amountPaidMXN()
    {
        return number_format($this->amount_paid_mxn, 4);
    }

    public function amountCredit()
    {
        return number_format($this->amount_credit, 4);
    }

    public function amountCreditMXN()
    {
        return number_format($this->amount_credit_mxn, 4);
    }

    public function total()
    {
        $total = $this->amount_paid + $this->amount_due;

        return number_format($total, 4);
    }

    public function totalMXN()
    {
        $total_mxn = $this->amount_paid_mxn + $this->amount_due_mxn;

        return number_format($total_mxn, 4);
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 0:
                return 'Insurance discount';

                break;
            case 1:
                return 'Personal discount';

                break;
            case 2:
                return 'No discounts';

                break;
        }
    }
}