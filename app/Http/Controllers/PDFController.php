<?php

namespace App\Http\Controllers;

use App\Actions\FillPaymentFormPDF;
use App\Actions\MergePDFs;
use App\Actions\PrepareInvoicePDF;
use App\Insuree;
use App\Invoice;
use App\Mail\PatientLetter as MailPatientLetter;
use App\Patient;
use App\PatientLetter;
use Barryvdh\DomPDF\Facade as BarryPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

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

    public function invoiceLetter(Invoice $invoice)
    {
        $filler = new FillPaymentFormPDF($invoice);
        $filler->saveFill();
        $merger = new MergePDFs(0);

        return $merger->mergeInvoice($invoice, $invoice->patient);
    }

    public function letter(Patient $patient, Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $invoices = Invoice::where([['patient_id', $patient->id],
            ['type', 2], ['registered', 1], ])
            ->whereBetween('date', [$start, $end])
            ->get()
        ;

        if (count($invoices) < 1) {
            return response('Sin facturas registradas');
        }

        $invoices_codes = '';
        $invoices_total = 0;
        foreach ($invoices as $invoice) {
            $invoices_codes .= $invoice->code.', ';
            $invoices_total += $invoice->total_with_discounts;
        }

        $letterPDF = $this->prepareLetter($patient, $invoices, $invoices_codes, $invoices_total);

        $store = storage_path('app/pdf/patients/'.$patient->id.'/temp/letter.pdf');
        Storage::put('pdf/patients/'.$patient->id.'/temp/letter.pdf', '');

        $letterPDF->save($store);

        $merger = new MergePDFs(0);

        if ($request->letter) {
            return $merger->mergeSimpleLetter($patient);
            // return $letterPDF->download($patient->full_name.'-Carta.pdf');
        }

        if ($request->mail) {
            $letter = $merger->mergeSimpleLetter($patient, false);

            $patient_letter = new PatientLetter();
            $patient_letter->patient_id = $patient->id;
            $patient_letter->date = Carbon::today();
            $patient_letter->content = $invoices_codes;
            $patient_letter->comments = $invoices_total;
            $patient_letter->status = 0;
            $patient_letter->reply = '';

            $insurer_email = null;
            if ($patient->insured) {
                $insurer_email = $patient->insuree->insurer->email;
            } else {
                $insurer_email = $patient->dependent->insuree->insurer->email;
            }
            if (is_null($insurer_email)) {
                return response('Correo de aseguranza no especificado.');
            }

            $email = new MailPatientLetter($patient, $letter);
            Mail::to($insurer_email)->send($email);

            $patient_letter->save();

            return redirect()->route('patients.show', [$patient])->withStatus(__('Correo enviado exitosamente.'));
        }

        foreach ($invoices as $invoice) {
            $filler = new FillPaymentFormPDF($invoice);
            $filler->saveFill();
        }

        return $merger->mergeLetter($patient);
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

    private function prepareLetter(Patient $patient, $invoices, $invoices_codes, $invoices_total)
    {
        if ($patient->insured) {
            $insuree = Insuree::where('patient_id', $patient->id)->first();
        } else {
            $insuree = Insuree::with('patient', 'insurer')
                ->where('patient_id', $patient->dependent->insuree_id)
                ->first()
            ;
        }

        $datetime = Carbon::now();

        $nf = new NumberFormatter('en', NumberFormatter::SPELLOUT);

        $total_spelled = $nf->format($invoices_total);

        $invoices_total = number_format($invoices_total, 2);

        view()->share([
            'patient' => $patient,
            'insuree' => $insuree,
            'invoices' => $invoices,
            'datetime' => $datetime,
            'codes' => $invoices_codes,
            'total' => $invoices_total,
            'amount' => $total_spelled,
        ]);

        return BarryPDF::loadView('pdf.letter');
    }
}