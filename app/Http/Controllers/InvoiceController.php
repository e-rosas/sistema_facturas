<?php

namespace App\Http\Controllers;

use App\Actions\PrepareInvoicePDF;
use App\Actions\SelectInsurance;
use App\DiagnosisService;
use App\Events\InvoiceEvent;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\UpdateInvoiceDetailsRequest;
use App\Http\Requests\UpdateInvoiceLocation;
use App\Http\Requests\UpdateInvoicePatient;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceDentalDetailsResource;
use App\Http\Resources\InvoiceDetailsResource;
use App\Http\Resources\InvoiceDiagnosesResource;
use App\Http\Resources\InvoiceHospitalizationDetailsResource;
use App\Http\Resources\InvoiceStatsResource;
use App\Insurance;
use App\Insuree;
use App\Invoice;
use App\InvoiceDentalDetails;
use App\InvoiceDentalService;
use App\InvoiceDiagnosis;
use App\InvoiceHospitalizationDetails;
use App\ItemService;
use App\Listeners\UpdatePersonStats;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!is_null($request->perPage)) {
            $perPage = $request->perPage;
        } else {
            $perPage = 15;
        }

        if (!empty($request['start'] && !empty($request['end']))) {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
        } else {
            $end = Carbon::today()->addDay();
            $start = Carbon::today()->subYears(3);
        }

        $invoices = Invoice::with('patient')->whereBetween('date', [$start, $end]);

        $search = '';

        if (!is_null($request['search'])) {
            $search = $request['search'];
            $invoices->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search);
        }

        $type = $request['type'];

        if ($type && $type < 4) {
            $type = $request['type'];
            $invoices->where('type', $type);
        }

        $status = $request['status'];
        if ($status && $status < 6) {
            $status = $request['status'];
            $invoices->where('status', $status);
        }

        $hospitalization = 0;

        if (!is_null($request['hospitalization'])) {
            $hospitalization = 1;
            $invoices->where('hospitalization', 1);
        }

        $dental = 0;

        if (!is_null($request['dental'])) {
            $dental = 1;
            $invoices->where('dental', 1);
        }

        $invoices = $invoices->paginate($perPage);

        return view('invoices.index', compact('invoices', 'search', 'perPage', 'type', 'status', 'end', 'start', 'hospitalization', 'dental'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $validated = $request->validated();
        $validated['type'] = 2;
        $validated['status'] = 3;

        if ('Pendiente' != $validated['number']) {
            $validated['registered'] = 1;
            $validated['status'] = 2;
        }

        if (is_null($request->code)) {
            //not cash
            if ($request->cash < 1) {
                $row = DB::table('invoice_counters')->first();
                $id = $row->counter + 1;
                $inital = config('app.initial');
                $validated['code'] = $inital.$id;
                DB::table('invoice_counters')
                    ->where('id', 1)
                    ->update(['counter' => $id])
            ;
            } else {
                $row = DB::table('invoice_counters')->where('id', 2)->first();
                $id = $row->counter + 1;
                $validated['code'] = 'CH.'.$id;
                $validated['cash'] = 1;
                DB::table('invoice_counters')
                    ->where('id', 2)
                    ->update(['counter' => $id])
            ;
            }
        }
        if ($request->cash > 0) {
            $validated['cash'] = 1;
        }

        $selectInsurance = new SelectInsurance();
        $validated['insurance_id'] = $selectInsurance->activeInsurance($validated['patient_id'])->id;

        $invoice = Invoice::create($validated);

        if ($validated['dental']) {
            $dental = new InvoiceDentalDetails();
            $dental->invoice_id = $invoice->id;
            $dental->enclosures = $request->enclosures;
            $dental->orthodontics = $request->orthodontics;
            $dental->appliance_placed = $request->appliance_placed;
            $dental->months_remaining = $request->months_remaining;
            $dental->prosthesis_replacement = $request->prosthesis_replacement;
            $dental->treatment_resulting_from = $request->treatment_resulting_from;
            $dental->prior_placement = $request->prior_placement;
            $dental->accident = $request->accident;
            $dental->auto_accident_state = $request->auto_accident_state;
            $dental->license = $request->license;
            $dental->tooth_numbers = $request->tooth_numbers;
            $dental->save();
        }
        if ($validated['hospitalization']) {
            $hosp = new InvoiceHospitalizationDetails();
            $hosp->invoice_id = $invoice->id;
            $hosp->bill_type = $request->bill_type;
            $hosp->diagnosis_codes = $request->diagnosis_codes;
            $hosp->breakdown = $request->breakdown;
            $hosp->save();
        }

        /* if (is_null($request->code)) {
            $inital = config('app.initial');
            $invoice->code = $inital.$invoice->id;
            $invoice->save();
        } */

        // $invoice_diagnoses_services = $request->invoice_diagnoses_services;

        $diagnoses = $request['diagnoses'];

        foreach ($diagnoses as $diagnosis) {
            $diagnosis['invoice_id'] = $invoice->id;
            InvoiceDiagnosis::create($diagnosis);
        }

        $services = $request['services'];
        foreach ($services as $service) {
            $service['invoice_id'] = $invoice->id;
            $diagnosis_service = DiagnosisService::create($service);
            if (isset($service['items'])) {
                $items = $service['items'];
                foreach ($items as $item) {
                    $item['diagnosis_service_id'] = $diagnosis_service->id;
                    ItemService::create($item);
                }
            }
            if ($invoice->dental) {
                $dental_service = new InvoiceDentalService();
                $dental_service->diagnosis_service_id = $diagnosis_service->id;
                $dental_service->oral_cavity = $service['oral_cavity'];
                $dental_service->tooth_system = $service['tooth_system'];
                $dental_service->tooth_numbers = $service['tooth_numbers'];
                $dental_service->tooth_surfaces = $service['tooth_surfaces'];
                $dental_service->missing = $service['missing'];

                $dental_service->save();
            }
        }

        return route('invoices.show', [$invoice]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice = $invoice->load('patient', 'payments', 'location', 'diagnoses.diagnosis', 'insurance');

        $pdf = new PrepareInvoicePDF($invoice);
        $categories = $pdf->serviceCategories();

        //$diagnoses_services = InvoiceDiagnosis::with('diagnoses', 'services.service', 'services.items')->where('invoice_id', $invoice->id)->get();
        $today = Carbon::today();

        $insuree = [];

        $insurances = [];

        if (!$invoice->patient->insured) {
            $insuree = Insuree::with('patient')
                ->where('patient_id', $invoice->patient->dependent->insuree_id)
                ->first()
            ;
            $insurances = Insurance::with('insurer')->where('insuree_id', $invoice->patient->dependent->insuree_id)->get();

        //return view('invoices.show', compact('invoice', 'insuree', 'today'));
        } else {
            $insurances = Insurance::with('insurer')->where('insuree_id', $invoice->patient->id)->get();
        }

        return view('invoices.show', compact('invoice', 'insuree', 'today', 'categories', 'insurances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        if (1 != $invoice->status) {
            return view('invoices.edit', compact('invoice'));
        }

        return redirect()->route('invoices.show', $invoice);
    }

    public function updateDetails(UpdateInvoiceDetailsRequest $request)
    {
        $validated = $request->validated();

        $invoice = Invoice::findOrFail($validated['invoice_id']);
        if ('Pendiente' != $validated['number']) {
            $invoice->status = 2;
            $invoice->registered = 1;
        }
        $invoice->fill($validated);

        $invoice->save();

        if ($invoice->hospitalization && !$validated['hospitalization']) {
            InvoiceHospitalizationDetails::where('invoice_id', $invoice->id)->delete();
        }

        if ($validated['hospitalization'] && !$invoice->hospitalization) {
            $oldHosp = InvoiceHospitalizationDetails::where('invoice_id', $invoice->id)->first();
            if($oldHosp) {
                $oldHosp->delete();
            }
            $hosp = new InvoiceHospitalizationDetails();
            $hosp->invoice_id = $invoice->id;
            $hosp->bill_type = $request->bill_type;
            $hosp->diagnosis_codes = $request->diagnosis_codes;
            $hosp->breakdown = $request->breakdown;
            $hosp->save();
        }
         if ($validated['hospitalization'] && $invoice->hospitalization) {
            $oldHosp = InvoiceHospitalizationDetails::where('invoice_id', $invoice->id)->first();
            if($oldHosp) {
                $oldHosp->delete();
            }

            $hosp = new InvoiceHospitalizationDetails();
            $hosp->invoice_id = $invoice->id;
            $hosp->bill_type = $request->bill_type;
            $hosp->diagnosis_codes = $request->diagnosis_codes;
            $hosp->breakdown = $request->breakdown;
            $hosp->save();
        }

        return new InvoiceDetailsResource($invoice);
    }

    public function updateDentalDetails(Request $request)
    {
        $dental = InvoiceDentalDetails::where('invoice_id', $request->invoice_id)->firstOrFail();
        $dental->enclosures = $request->enclosures;
        $dental->orthodontics = $request->orthodontics;
        $dental->appliance_placed = $request->appliance_placed;
        $dental->months_remaining = $request->months_remaining;
        $dental->prosthesis_replacement = $request->prosthesis_replacement;
        $dental->treatment_resulting_from = $request->treatment_resulting_from;
        $dental->prior_placement = $request->prior_placement;
        $dental->accident = $request->accident;
        $dental->auto_accident_state = $request->auto_accident_state;
        $dental->license = $request->license;
        $dental->tooth_numbers = $request->tooth_numbers;
        $dental->update();

        return new InvoiceDentalDetailsResource($dental);
    }

    public function updateHospitalizationDetails(Request $request)
    {
        $hosp = InvoiceHospitalizationDetails::where('invoice_id', $request->invoice_id)->firstOrFail();
        $hosp->bill_type = $request->bill_type;
        $hosp->diagnosis_codes = $request->diagnosis_codes;
        $hosp->breakdown = $request->breakdown;
        $hosp->update();

        return new InvoiceHospitalizationDetailsResource($hosp);
    }

    public function newInsurance(Request $request)
    {
        $new_insurance_id = $request->insurance_id;
        $invoice_id = $request->invoice_id;
        $invoice = Invoice::findOrFail($invoice_id);
        Insurance::findOrFail($new_insurance_id);
        $invoice->insurance_id = $new_insurance_id;
        $invoice->save();

        return back()->withStatus(__('Aseguranza actualizada exitosamente.'));
    }

    public function updatePatient(UpdateInvoicePatient $request)
    {
        $new_patient_id = $request->patient_id;
        $invoice_id = $request->invoice_id;

        $invoice = Invoice::findOrFail($invoice_id);
        $new_patient = Patient::findOrFail($new_patient_id);
        $old_patient_id = $invoice->patient_id;

        $invoice->patient_id = $new_patient->id;
        $selectInsurance = new SelectInsurance();
        $invoice->insurance_id = $selectInsurance->activeInsurance($new_patient->id)->insurance_id;
        $invoice->save();

        event(new InvoiceEvent($invoice)); //update stats for new patient
        $update_stats = new UpdatePersonStats();
        $update_stats->updateStats($old_patient_id); //update stats for old patient

        return back()->withStatus(__('Paciente actualizado exitosamente.'));
    }

    public function updateLocation(UpdateInvoiceLocation $request)
    {
        $new_location_id = $request->location_id;
        $invoice_id = $request->invoice_id;

        $invoice = Invoice::findOrFail($invoice_id);

        $invoice->location_id = $new_location_id;
        $invoice->save();

        return back()->withStatus(__('Ubicación actualizado exitosamente.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Invoice             $invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request)
    {
        $validated = $request->validated();
        $invoice = Invoice::findOrFail($validated['invoice_id']);

        if ($invoice->dental && !$validated['dental']) {
            InvoiceDentalDetails::where('invoice_id', $invoice->id)->delete();
        }

        if ($invoice->dental && $validated['dental']) {
            InvoiceDentalDetails::where('invoice_id', $invoice->id)->delete();

            $dental = new InvoiceDentalDetails();
            $dental->invoice_id = $invoice->id;
            $dental->enclosures = $request->enclosures;
            $dental->orthodontics = $request->orthodontics;
            $dental->appliance_placed = $request->appliance_placed;
            $dental->months_remaining = $request->months_remaining;
            $dental->prosthesis_replacement = $request->prosthesis_replacement;
            $dental->treatment_resulting_from = $request->treatment_resulting_from;
            $dental->prior_placement = $request->prior_placement;
            $dental->accident = $request->accident;
            $dental->auto_accident_state = $request->auto_accident_state;
            $dental->license = $request->license;
            $dental->tooth_numbers = $request->tooth_numbers;
            $dental->save();
        }

        if (!$invoice->dental && $validated['dental']) {
            
            $dental = new InvoiceDentalDetails();
            $dental->invoice_id = $invoice->id;
            $dental->enclosures = $request->enclosures;
            $dental->orthodontics = $request->orthodontics;
            $dental->appliance_placed = $request->appliance_placed;
            $dental->months_remaining = $request->months_remaining;
            $dental->prosthesis_replacement = $request->prosthesis_replacement;
            $dental->treatment_resulting_from = $request->treatment_resulting_from;
            $dental->prior_placement = $request->prior_placement;
            $dental->accident = $request->accident;
            $dental->auto_accident_state = $request->auto_accident_state;
            $dental->license = $request->license;
            $dental->tooth_numbers = $request->tooth_numbers;
            $dental->save();
        }

        if ($invoice->hospitalization && !$validated['hospitalization']) {
            InvoiceHospitalizationDetails::where('invoice_id', $invoice->id)->delete();
        }

        if ($validated['hospitalization'] && !$invoice->hospitalization) {
            $oldHosp = InvoiceHospitalizationDetails::where('invoice_id', $invoice->id)->first();
            if($oldHosp) {
                $oldHosp->delete();
            }
            $hosp = new InvoiceHospitalizationDetails();
            $hosp->invoice_id = $invoice->id;
            $hosp->bill_type = $request->bill_type;
            $hosp->diagnosis_codes = $request->diagnosis_codes;
            $hosp->breakdown = $request->breakdown;
            $hosp->save();
        }
         if ($validated['hospitalization'] && $invoice->hospitalization) {
            $oldHosp = InvoiceHospitalizationDetails::where('invoice_id', $invoice->id)->first();
            if($oldHosp) {
                $oldHosp->delete();
            }

            $hosp = new InvoiceHospitalizationDetails();
            $hosp->invoice_id = $invoice->id;
            $hosp->bill_type = $request->bill_type;
            $hosp->diagnosis_codes = $request->diagnosis_codes;
            $hosp->breakdown = $request->breakdown;
            $hosp->save();
        }

        $invoice->fill($validated);

        InvoiceDiagnosis::where('invoice_id', $invoice->id)->delete();
        DiagnosisService::where('invoice_id', $invoice->id)->delete();

        $diagnoses = $request['diagnoses'];

        foreach ($diagnoses as $diagnosis) {
            $diagnosis['invoice_id'] = $invoice->id;
            InvoiceDiagnosis::create($diagnosis);
        }

        $services = $request['services'];
        foreach ($services as $service) {
            $service['invoice_id'] = $invoice->id;
            $diagnosis_service = DiagnosisService::create($service);
            if (isset($service['items'])) {
                $invoice->status = 4;
                $items = $service['items'];
                foreach ($items as $item) {
                    $item['diagnosis_service_id'] = $diagnosis_service->id;
                    ItemService::create($item);
                }
            }

            if ($invoice->dental) {
                $dental_service = new InvoiceDentalService();
                $dental_service->diagnosis_service_id = $diagnosis_service->id;
                $dental_service->oral_cavity = $service['oral_cavity'];
                $dental_service->tooth_system = $service['tooth_system'];
                $dental_service->tooth_numbers = $service['tooth_numbers'];
                $dental_service->tooth_surfaces = $service['tooth_surfaces'];
                $dental_service->save();
            }
        }

        $invoice->save();
        event(new InvoiceEvent($invoice));

        return route('invoices.show', $invoice);
    }

    public function updateStatus(Request $request)
    {
        $invoice = Invoice::findOrFail($request['invoice_id']);
        $invoice->status = $request['status'];
        $invoice->save();

        return new InvoiceStatsResource($invoice);
    }

    public function getDentalDetails(Request $request)
    {
        $dental = InvoiceDentalDetails::where('invoice_id', $request['invoice_id'])->firstOrFail();

        return new InvoiceDentalDetailsResource($dental);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $old_patient_id = $invoice->patient_id;
        $invoice->delete();
        $update_stats = new UpdatePersonStats();
        $update_stats->updateStats($old_patient_id); //update stats for old patient

        return redirect()->route('invoices.index')->withStatus(__('Cobro eliminado exitosamente.'));
    }

    public function changeStatus(Invoice $invoice, Request $request)
    {
        $invoice->type = $request->type;
        $invoice->save();

        return redirect()->route('invoices.show', $invoice)->withStatus(__('Tipo actualizado exitosamente.'));
    }

    public function updateRegistered()
    {
        $invoices = Invoice::where([['status', '3'], ['number', '!=', 'Pendiente'], ['amount_paid', '0']])->get();
        foreach ($invoices as $invoice) {
            $invoice->status = 2;
            $invoice->save();
        }
    }

    public function updateHospitalizations()
    {
        $invoices = Invoice::where('hospitalization', 1)->get();
        foreach ($invoices as $invoice) {
            $hosp = new InvoiceHospitalizationDetails();
            $hosp->invoice_id = $invoice->id;
            $hosp->bill_type = '';
            $hosp->diagnosis_codes = '';
            $hosp->breakdown = false;
            $hosp->save();
        }
    }

    public function searchNumber(Request $request)
    {
        $number = $request->number;
        $claim = $request->claim;
        if ($claim > 0) {
            $invoice = Invoice::with('diagnoses', 'patient')
                ->where('code', $number)
                ->first()
        ;
        } else {
            $invoice = Invoice::with('diagnoses', 'patient')
                ->where('number', $number)
                ->first()
        ;
        }

        return new InvoiceDiagnosesResource($invoice);
    }

    public function find(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);

        return new InvoiceStatsResource($invoice);
    }
}
