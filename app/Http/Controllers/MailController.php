<?php

namespace App\Http\Controllers;

use App\Actions\PreparePatientLetter;
use App\Actions\SelectInsurance;
use App\Actions\SendMailjet;
use App\Campaign;
use App\Patient;
use App\PatientLetter as AppPatientLetter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function letter(Patient $patient, Request $request)
    {
        $campaign = Campaign::findOrFail($request->campaign_id);

        $user_id = $request->user()->id;
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $selectInsurance = new SelectInsurance();
        $insurances = $selectInsurance->patientInsurances($patient);

        $invoices = new Collection();

        $preparePatientLetter = new PreparePatientLetter();

        foreach ($insurances as $insurance) {
            if ('pendiente@pendiente.com' != $insurance->insurer->email) {
                $insuranceInvoices = $preparePatientLetter->getInsurancePatientInvoices($insurance, $patient, $start, $end);
                $invoices = $invoices->merge($insuranceInvoices);
            }
        }

        if (count($invoices) < 1) {
            return response('Sin facturas registradas');
        }

        $mailjet = new SendMailjet();

        if ($request->letter) {
            return $preparePatientLetter->prepareLetter($insurance, $patient, $invoices, true);
        }

        if ($request->mail) {
            $letter = $preparePatientLetter->prepareLetter($insurance, $patient, $invoices);

            if ($mailjet->sendCampaignEmail($campaign, $insurance, $patient, $letter, $user_id)) {
                $patient_letter = new AppPatientLetter();
                $patient_letter->patient_id = $patient->id;
                $patient_letter->date = Carbon::today();
                $patient_letter->content = $preparePatientLetter->invoiceContent;
                $patient->comments = 'Total: '.$preparePatientLetter->invoiceTotal.' Periodo: '.$start->format('M-d-Y').' - '.$end->format('M-d-Y');
                $patient_letter->status = 0;
                $patient_letter->save();

                return back()->withStatus(__('Carta enviada exitosamente.'));
            }

            return response('Error al enviar correo.');
        }
    }
}
