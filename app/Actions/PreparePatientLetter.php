<?php

namespace App\Actions;

use App\Dependent;
use App\Insurance;
use App\Insuree;
use App\Invoice;
use App\Patient;
use Carbon\Carbon;
use NumberFormatter;
use Barryvdh\DomPDF\Facade as BarryPDF;
use Illuminate\Support\Facades\Storage;
use App\Actions\MergePDFs;

class PreparePatientLetter
{
    public $invoiceContent = "";
    public $invoiceTotal = 0;
    public function getInsurancePatients(Insurance $insurance)
    {
        $patients = [];
        $patients[] = Patient::findOrFail($insurance->insuree_id);

        $dependents = Dependent::with('patient')->where('insuree_id', $insurance->insuree_id)->get();
        foreach ($dependents as $dependent) {
            $patients[] = $dependent->patient;
        }

        return $patients;
    }

    public function getInsurancePatientInvoices(Insurance $insurance, Patient $patient, Carbon $start, Carbon $end)
    {
        $date = 'date';

        $registered = 1;
        if ('C' == config('app.initial')) {
            $registered = 0;
            $date = 'DOS';
        }
        return Invoice::where([['insurance_id', $insurance->id],
            ['type', 2], ['registered', $registered], ['patient_id', $patient->id], ])
            ->whereBetween($date, [$start, $end])
            ->get()
        ;
    }

    public function prepareLetter(Insurance $insurance, Patient $patient, $invoices, $download = false)
    {
       

        $datetime = Carbon::now();

        foreach ($invoices as $invoice) {
            $this->invoiceContent .= $invoice->code.', ';
           $this->invoiceTotal += $invoice->total_with_discounts;
        }
        $nf = new NumberFormatter('en', NumberFormatter::SPELLOUT);


        $total_spelled = $nf->format( $this->invoiceTotal);

       $this->invoiceTotal = number_format( $this->invoiceTotal, 2);


        view()->share([
            'patient' => $patient,
            'insuree' => $insurance->insuree,
            'insurance' => $insurance,
            'invoices' => $invoices,
            'datetime' => $datetime,
            'codes' => $this->invoiceContent,
            'total' =>$this->invoiceTotal,
            'amount' => $total_spelled,
        ]);

        $letterPDF = BarryPDF::loadView('pdf.letter');

        $store = storage_path('app/pdf/patients/'.$patient->id.'/temp/letter.pdf');
        Storage::put('pdf/patients/'.$patient->id.'/temp/letter.pdf', '');

        $letterPDF->save($store);

        $merger = new MergePDFs(0);

        return $merger->mergeSimpleLetter($patient, $download);

    }
}
