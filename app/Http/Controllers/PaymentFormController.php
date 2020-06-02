<?php

namespace App\Http\Controllers;

use App\Actions\FillPaymentFormPDF;
use App\Invoice;

class PaymentFormController extends Controller
{
    public function test()
    {
        $filler = new FillPaymentFormPDF(Invoice::findOrFail(104));
        $filler->test();
    }
}
