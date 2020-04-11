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
        'personal_amount_due',
        'total_amount_due',
        'patient_id',
    ];
    protected $casts = [
        'patient_id' => 'integer',
        'status' => 'integer',
        'amount_paid' => 'decimal:13',
        'amount_due' => 'decimal:13',
        'total_amount_due' => 'decimal:13',
        'personal_amount_due' => 'decimal:13',
    ];

    /**
     * Get the value of amount_due.
     */
    public function getAmount_due()
    {
        return number_format($this->amount_due, 3);
    }

    /**
     * Get the value of personal_amount_due.
     */
    public function getPersonalAmountDue()
    {
        return number_format($this->personal_amount_due, 3);
    }

    public function getTotalAmountDue()
    {
        return number_format($this->total_amount_due, 3);
    }

    /**
     * Get the value of amount_paid.
     */
    public function getAmount_paid()
    {
        return number_format($this->amount_paid, 3);
    }

    public function getTotal()
    {
        if (1 == $this->status) {
            $total = $this->amount_paid + $this->personal_amount_due;

            return number_format($total, 3);
        }

        $total = $this->amount_paid + $this->amount_due;

        return number_format($total, 3);
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
