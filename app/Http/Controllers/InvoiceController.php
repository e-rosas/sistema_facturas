<?php

namespace App\Http\Controllers;

use App\DiagnosisService;
use App\Events\InvoiceEvent;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\UpdateInvoiceDetailsRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceDetailsResource;
use App\Http\Resources\InvoiceStatsResource;
use App\Insuree;
use App\Invoice;
use App\InvoiceDiagnosis;
use App\InvoiceDiagnosisList;
use App\ItemService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        if (is_null($request['search'])) {
            $search = '';
        } else {
            $search = $request['search'];
        }
        if (is_null($request['type'])) {
            $type = 3;
        } else {
            $type = $request['type'];
        }
        if (is_null($request['status'])) {
            $status = 6;
        } else {
            $status = $request['status'];
        }

        if ($type < 3 && $status < 6) {
            $invoices = Invoice::with('patient')
                ->where([['type', $type], ['status', $status]])
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->paginate($perPage)
        ;
        } elseif ($type >= 3 && $status < 6) {
            $invoices = Invoice::with('patient')
                ->where('status', $status)
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->paginate($perPage)
        ;
        } elseif ($type < 3 && $status >= 6) {
            $invoices = Invoice::with('patient')
                ->where('type', $type)
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->paginate($perPage)
        ;
        } else {
            $invoices = Invoice::with('patient')
                ->whereLike(['number', 'code', 'patient.full_name', 'comments'], $search)
                ->paginate($perPage)
            ;
        }

        return view('invoices.index', compact('invoices', 'search', 'perPage', 'type', 'status'));
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
        $invoice = Invoice::create($validated);

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
        }

        /* foreach ($invoice_diagnoses_services as $diagnoses_services) {
            $invoice_diagnosis = new InvoiceDiagnosis();
            $invoice_diagnosis->invoice_id = $invoice->id;
            $invoice_diagnosis->save();

            $diagnoses = $diagnoses_services['diagnoses'];

            foreach ($diagnoses as $diagnosis) {
                $diagnosis['invoice_diagnoses_id'] = $invoice_diagnosis->id;
                InvoiceDiagnosisList::create($diagnosis);
            }

            $services = $diagnoses_services['services'];
            foreach ($services as $service) {
                $service['invoice_diagnoses_id'] = $invoice_diagnosis->id;
                $diagnosis_service = DiagnosisService::create($service);
                if (isset($service['items'])) {
                    $items = $service['items'];
                    foreach ($items as $item) {
                        $item['diagnosis_service_id'] = $diagnosis_service->id;
                        ItemService::create($item);
                    }
                }
            }
        } */

        return route('invoices.show', [$invoice]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice = $invoice->load('patient', 'payments', 'calls', 'services2.service', 'services2.items', 'diagnoses.diagnosis');

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

        return view('invoices.show', compact('invoice', 'insuree', 'today'));
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
        }
        $invoice->fill($validated);

        $invoice->save();

        return new InvoiceDetailsResource($invoice);
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

    public function searchNumber(Request $request)
    {
        $search = $request->search;
        $invoices = Invoice::query()
            ->where('patient_id', $request->patient_id)
            ->whereLike('number', $search)
            ->get()->take(8)
        ;
        $response = [];
        foreach ($invoices as $invoice) {
            $response[] = [
                'id' => $invoice->id,
                'text' => $invoice->number.' '.$invoice->date->format('m-d-y'),
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function find(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);

        return new InvoiceStatsResource($invoice);
    }

    
}
