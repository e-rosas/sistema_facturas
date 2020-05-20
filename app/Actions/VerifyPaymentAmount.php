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
        if (1 == $this->invoice->status) {
            return 3;
        }
        $new_amount_due = $this->invoice->amount_due - $this->amount;
        if ($new_amount_due >= 0) {
            return $this->updateInvoice($new_amount_due);
        }

        return 2;
    }

    public function verifyUpdatePayment($old_payment_amount)
    {
        if (1 == $this->invoice->status) {
            return 3;
        }
        $new_amount_due = $this->invoice->amount_due + $old_payment_amount - $this->amount;
        if ($new_amount_due >= 0) {
            return $this->updateInvoice($new_amount_due);
        }

        return 2;
    }

    public function paymentType()
    {
        if (5 == $this->invoice->status) {
            return 1; //charge
        }

        return 0;
    }

    public function verifyDeletePayment()
    {
        if (1 == $this->invoice->status) {
            return false;
        }

        return true;
    }

    private function updateInvoice($new_amount_due)
    {
        if (2 == $this->invoice->type && 0 == $new_amount_due) {
            $this->invoice->type = 1; //unique payment
            $this->invoice->status = 1; //completed
            $this->invoice->save();

            return 1;
        }

        $this->invoice->type = 0; //credit pending
        //$this->invoice->status = 0;
        $this->invoice->save();

        return 0;
    }
}
