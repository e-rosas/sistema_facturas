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
        $invoices = Invoice::where([['patient_id', $patient->id], ['registered', 1], ['status', '!=', 1]])->get();

        if ($patient->insured) {
            $insuree = Insuree::where('patient_id', $patient->id)->first();
        } else {
            $insuree = Insuree::with('patient', 'insurer')
                ->where('patient_id', $patient->dependent->insuree_id)
                ->first()
            ;
        }

        $datetime = Carbon::now();

        $invoices_codes = '';
        $invoices_total = 0;
        foreach ($invoices as $invoice) {
            $invoices_codes .= $invoice->code.',';
            $invoices_total += $invoice->total_with_discounts;
        }

        $invoices_total = number_format($invoices_total, 4);

        view()->share([
            'patient' => $patient,
            'insuree' => $insuree,
            'invoices' => $invoices,
            'datetime' => $datetime,
            'codes' => $invoices_codes,
            'total' => $invoices_total,
        ]);

        $letterPDF = BarryPDF::loadView('pdf.letter');

        return $letterPDF->download($patient->full_name.'-Letter.pdf');
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
