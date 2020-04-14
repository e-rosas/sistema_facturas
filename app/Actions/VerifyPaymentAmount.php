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
        if($new_amount_due >= 0){
            if($this->invoice->type == 2 && $new_amount_due ==0){
                $this->invoice->type = 1;
                $this->invoice->status = 1;
                $this->invoice->save();
            }
            return true;
        }
        else {
            return false;
        }
    }
}
