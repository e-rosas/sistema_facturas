<?php

namespace App\Http\Controllers;

use App\Actions\MergePDFs;
use App\Insuree;
use App\Invoice;
use App\Jobs\SendPatientLetterEmail;
use App\Mail\PatientLetter;
use App\Patient;
use App\PatientLetter as AppPatientLetter;
use Barryvdh\DomPDF\Facade as BarryPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class MailController extends Controller
{
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

        $letterPDF = $this->prepareLetter($patient, $invoices);

        $store = storage_path('app/pdf/patients/'.$patient->id.'/temp/letter.pdf');
        Storage::put('pdf/patients/'.$patient->id.'/temp/letter.pdf', '');

        $letterPDF->save($store);

        $merger = new MergePDFs(0);

        $letter = $merger->mergeSimpleLetter($patient, false);

        $patient_letter = new AppPatientLetter();
        $patient_letter->patient_id = $patient->id;
        $patient_letter->sent_on = Carbon::today();

        $insurer_email = null;
        if ($patient->insured) {
            $insurer_email = $patient->insuree->insurer->email;
        } else {
            $insurer_email = $patient->dependent->insuree->insurer->email;
        }
        if (is_null($insurer_email)) {
            return response('Correo de aseguranzda no especificado.');
        }

        $email = new PatientLetter($patient, $letter);
        Mail::to('hospmex.sistemas@gmail.com')->queue($email);

        //SendPatientLetterEmail::dispatch($patient, $letter, 'hospmex.sistemas@gmail.com');
    }

    private function prepareLetter(Patient $patient, $invoices)
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

        $invoices_codes = '';
        $invoices_total = 0;
        foreach ($invoices as $invoice) {
            $invoices_codes .= $invoice->code.', ';
            $invoices_total += $invoice->total_with_discounts;
        }
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