<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Invoice;
use App\InvoiceService;
use App\ItemService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with(['patient'])->paginate(15);

        return view('invoices.index', compact('invoices'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $validated = $request->validated();
        $validated['type'] = 2;
        $validated['status'] = 3;
        $validated['exchange_rate'] = 0;
        $invoice = Invoice::create($validated);

        $services = $request->services;
        foreach ($services as $service) {
            $service['invoice_id'] = $invoice->id;
            $invoice_service = InvoiceService::create($service);
            if (isset($service['items'])) {
                $items = $service['items'];
                foreach ($items as $item) {
                    $item['invoice_service_id'] = $invoice_service->id;
                    ItemService::create($item);
                }
            }
        }

        return route('invoices.show', [$invoice]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice = $invoice->load('services.service', 'patient', 'payments');

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $invoice->loadMissing('services');

        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request)
    {
        $validated = $request->validated();
        $invoice = Invoice::findOrFail($validated['invoice_id']);

        $invoice->fill($validated);

        InvoiceService::where('invoice_id', $invoice->id)->delete();

        $services = $request->services;
        foreach ($services as $service) {
            $service['invoice_id'] = $invoice->id;
            $invoice_service = InvoiceService::create($service);
            if (isset($service['items'])) {
                $items = $service['items'];
                foreach ($items as $item) {
                    $item['invoice_service_id'] = $invoice_service->id;
                    ItemService::create($item);
                }
                $invoice->status = 4;
            }
        }

        $invoice->save();

        return route('invoices.show', [$invoice]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $invoices = Invoice::whereLike(['number', 'code', 'patient.full_name', 'patient.insurance_id'], $search)
            ->paginate(15)
        ;

        return view('invoices.index', compact('invoices'));
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

        return new InvoiceResource($invoice);
    }
}
