<?php

namespace App\Http\Controllers;

use App\Actions\FillDentalFormPDF;
use App\Actions\FillPaymentFormPDF;
use App\Actions\FillHospitalizationFormPDF;
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

    public function fillDental(Invoice $invoice, Request $request)
    {
        $output = $request['output'];

        $filler = new FillDentalFormPDF($invoice);
        $filler->fill($output);
    }
    public function fillHospitalization(Invoice $invoice, Request $request)
    {
        $output = $request['output'];

        $filler = new FillHospitalizationFormPDF($invoice);
        $filler->fill($output);
    }
}