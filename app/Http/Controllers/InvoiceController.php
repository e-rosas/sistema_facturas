<?php

namespace App\Http\Controllers;

use App\Actions\PrepareInvoicePDF;
use App\DiagnosisService;
use App\Events\InvoiceEvent;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\UpdateInvoiceDetailsRequest;
use App\Http\Requests\UpdateInvoicePatient;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceDetailsResource;
use App\Http\Resources\InvoiceDiagnosesResource;
use App\Http\Resources\InvoiceStatsResource;
use App\Insuree;
use App\Invoice;
use App\InvoiceDentalDetails;
use App\InvoiceDentalService;
use App\InvoiceDiagnosis;
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

        if (is_null($request['search'])) {
            $search = '';
        } else {
            $search = $request['search'];
        }
        if (is_null($request['type'])) {
            $type = 4;
        } else {
            $type = $request['type'];
        }
        if (is_null($request['status'])) {
            $status = 6;
        } else {
            $status = $request['status'];
        }

        if ($type < 4 && $status < 6) {
            $invoices = Invoice::with('patient')
                ->where([['type', $type], ['status', $status]])
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->whereBetween('date', [$start, $end])
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        } elseif ($type >= 4 && $status < 6) {
            $invoices = Invoice::with('patient')
                ->where('status', $status)
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->whereBetween('date', [$start, $end])
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        } elseif ($type < 4 && $status >= 6) {
            $invoices = Invoice::with('patient')
                ->where('type', $type)
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->whereBetween('date', [$start, $end])
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        } else {
            $invoices = Invoice::with('patient')
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->whereBetween('date', [$start, $end])
                ->orderBy('date', 'desc')
                ->paginate($perPage)
            ;
        }

        return view('invoices.index', compact('invoices', 'search', 'perPage', 'type', 'status', 'end', 'start'));
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
                DB::table('invoice_counters')
                    ->where('id', 2)
                    ->update(['counter' => $id])
            ;
            }
        }

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
            $dental->save();
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
                $dental_service->oral_cavity = $service->oral_cavity;
                $dental_service->tooth_system = $service->tooth_system;
                $dental_service->tooth_numbers = $service->tooth_numbers;
                $dental_service->tooth_surfaces = $service->tooth_surfaces;
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
        $invoice = $invoice->load('patient', 'payments', 'calls', 'diagnoses.diagnosis');

        $pdf = new PrepareInvoicePDF($invoice);
        $categories = $pdf->serviceCategories();

        //$diagnoses_services = InvoiceDiagnosis::with('diagnoses', 'services.service', 'services.items')->where('invoice_id', $invoice->id)->get();
        $today = Carbon::today();

        $insuree = [];

        if (!$invoice->patient->insured) {
            $insuree = Insuree::with('patient', 'insurer')
                ->where('patient_id', $invoice->patient->dependent->insuree_id)
                ->first()
            ;

            //return view('invoices.show', compact('invoice', 'insuree', 'today'));
        }

        return view('invoices.show', compact('invoice', 'insuree', 'today', 'categories'));
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

        return new InvoiceDetailsResource($invoice);
    }

    public function updatePatient(UpdateInvoicePatient $request)
    {
        $new_patient_id = $request->patient_id;
        $invoice_id = $request->invoice_id;

        $invoice = Invoice::findOrFail($invoice_id);
        $new_patient = Patient::findOrFail($new_patient_id);
        $old_patient_id = $invoice->patient_id;

        $invoice->patient_id = $new_patient->id;
        $invoice->save();

        event(new InvoiceEvent($invoice)); //update stats for new patient
        $update_stats = new UpdatePersonStats();
        $update_stats->updateStats($old_patient_id); //update stats for old patient

        return back()->withStatus(__('Paciente actualizado exitosamente.'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
    }

    public function updateRegistered()
    {
        $invoices = Invoice::where('number', '!=', 'Pendiente')->get();
        foreach ($invoices as $invoice) {
            $invoice->registered = 1;
            $invoice->save();
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