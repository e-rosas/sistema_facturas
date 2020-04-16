<?php

namespace App\Actions;

use App\Invoice;

class VerifyPaymentAmount
{
    private $invoice;
    private $amount;

    public function __construct($amount, $invoice_id)
    {
        $this->amount = $amount;
        $this->invoice = Invoice::find($invoice_id);
    }

    public function verifyPayment()
    {
        $new_amount_due = $this->invoice->amount_due - $this->amount;
        if ($new_amount_due >= 0) {
            if (2 == $this->invoice->type && 0 == $new_amount_due) {
                $this->invoice->type = 1; //unique payment
                $this->invoice->status = 1; //completed
                $this->invoice->save();

                return 1;
            }

            $this->invoice->type = 0; //credit pending
            $this->invoice->status = 0;
            $this->invoice->save();

            return 0;
        }

        return 2;
    }
}
