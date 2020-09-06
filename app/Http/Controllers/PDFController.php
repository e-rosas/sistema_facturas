<?php

namespace App\Http\Controllers;

use App\Actions\PrepareInvoicePDF;
use App\Insuree;
use App\Invoice;
use App\Patient;
use Barryvdh\DomPDF\Facade as BarryPDF;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function hospitalization(Invoice $invoice)
    {
        $pdf = new PrepareInvoicePDF($invoice);
        $categories = $pdf->serviceCategories();
        $insured = $pdf->insured;
        $patient = $pdf->patient;
        $invoice_total = number_format($invoice->total_with_discounts, 2);
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

        return $hospPDF->download($invoice->code.'-Hosp.pdf');
    }

    public function letter(Patient $patient)
    {
        $patient->load('invoices');

        if ($patient->insured) {
            $insuree = Insuree::where('insuree_id', $patient->id)->first();
        } else {
            $insuree = Insuree::with('patient', 'insurer')
                ->where('patient_id', $patient->dependent->insuree_id)
                ->first()
            ;
        }
        $datetime = Carbon::now();

        view()->share([
            'patient' => $patient,
            'insuree' => $insuree,
            'datetime' => $datetime,
        ]);

        $letterPDF = BarryPDF::loadView('pdf.letter');

        return $letterPDF->download($patient->name.'-Hosp.pdf');
    }

    public function categories(Invoice $invoice)
    {
        $pdf = new PrepareInvoicePDF($invoice);
        $categories = $pdf->serviceCategories();
        $insured = $pdf->insured;
        $patient = $pdf->patient;
        $invoice_total = number_format($invoice->total_with_discounts, 2);
        $datetime = Carbon::now();

        view()->share([
            'patient' => $patient,
            'insured' => $insured,
            'invoice' => $invoice,
            'categories' => $categories,
            'invoice_total' => $invoice_total,
            'datetime' => $datetime,
        ]);

        $hospPDF = BarryPDF::loadView('pdf.category');

        return $hospPDF->download($invoice->code.'-categorias.pdf');
    }
}
