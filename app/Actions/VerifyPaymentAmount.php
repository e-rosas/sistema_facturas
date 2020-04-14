<?php

namespace App\Actions;
use app\Invoice;
use Carbon\Carbon;

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
            return true;
        }
        else {
            return false;
        }
    }
}
