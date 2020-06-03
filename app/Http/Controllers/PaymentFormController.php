<?php

namespace App\Http\Controllers;

use App\Actions\FillPaymentFormPDF;
use App\Invoice;
use Illuminate\Http\Request;

class PaymentFormController extends Controller
{
    public function fill(Invoice $invoice, Request $request)
    {
        $output = $request['output'];

        $filler = new FillPaymentFormPDF($invoice);
        $filler->fill($output);
    }
}
