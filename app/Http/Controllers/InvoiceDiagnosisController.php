<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\DiagnosisService;
use App\Http\Resources\InvoiceDiagnosisResource;
use App\Invoice;
use App\InvoiceDiagnosis;
use App\Service;
use Illuminate\Http\Request;

class InvoiceDiagnosisController extends Controller
{
    public function getInvoiceDiagnoses(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $diagnoses = InvoiceDiagnosis::where('invoice_id', $invoice_id)->orderBy('id')->get();

        return InvoiceDiagnosisResource::collection($diagnoses);
    }

    public function migrate()
    {
        $invoices = Invoice::where('id', '<', 9)->get();
        foreach ($invoices as $invoice) {
            $diagnoses = [];
            $unique_diagnoses = [];
            foreach ($invoice->services as $service) {
                $diagnosis_id = $service->diagnosis_id;
                array_push($diagnoses, $diagnosis_id);
                $unique_diagnoses = array_values(array_unique($diagnoses));
            }
            foreach ($unique_diagnoses as $id) {
                $diagnosis = new InvoiceDiagnosis();
                $diagnosis->invoice_id = $invoice->id;
                $diagnosis->diagnosis_id = $id;
                $diagnosis_db = Diagnosis::findOrFail($id);
                $diagnosis->diagnosis_code = $diagnosis_db->code;
                $diagnosis->save();
            }
            foreach ($invoice->services as $service) {
                $diagnosis_id = $service->diagnosis_id;
                $found_key = array_search($diagnosis_id, $unique_diagnoses);
                $new_service = new DiagnosisService();
                $new_service->invoice_id = $invoice->id;
                $new_service->service_id = $service->service_id;
                $new_service->price = $service->price;
                $new_service->discounted_price = $service->discounted_price;
                $new_service->tax = $service->tax;
                $new_service->sub_total = $service->sub_total;
                $new_service->sub_total_discounted = $service->sub_total_discounted;
                $new_service->total_price = $service->total_price;
                $new_service->total_discounted_price = $service->total_discounted_price;
                $new_service->description = $service->description;
                $new_service->descripcion = $service->service->descripcion;
                $new_service->quantity = $service->quantity;
                $new_service->DOS = $service->DOS;
                $new_service->DOS_to = $service->DOS;
                $new_service->diagnoses_pointers = $found_key + 1;
                $new_service->code = $service->code;
                $new_service->dtax = $service->dtax;
                //array_push($services, $new_service);
                $new_service->save();
            }
            /* array_push($all['diagnoses'], $unique_diagnoses);
            array_push($all['services'], $services); */
            //dd($all);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceDiagnosis $invoiceDiagnosis)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceDiagnosis $invoiceDiagnosis)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceDiagnosis $invoiceDiagnosis)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceDiagnosis $invoiceDiagnosis)
    {
    }
}
