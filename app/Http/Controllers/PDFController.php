<?php

namespace App\Http\Controllers;

use App\Actions\PrepareInvoicePDF;
use App\Invoice;
use Barryvdh\DomPDF\Facade as BarryPDF;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function hospitalization()
    {
        $invoice = Invoice::find(75);
        $pdf = new PrepareInvoicePDF($invoice);
        $categories = $pdf->serviceCategories();
        $insured = $pdf->insured;
        $patient = $pdf->patient;
        $invoice_total = $invoice->totalDiscounted();
        $datetime = Carbon::now();

        view()->share([
            'patient' => $patient,
            'insured' => $insured,
            'invoice' => $invoice,
            'categories' => $categories,
            'invoice_total' => $invoice_total,
            'datetime' => $datetime,
        ]);

        $hospPDF = BarryPDF::loadView('pdf.hospitalization');

        return $hospPDF->stream($invoice->code);
    }
}
