<?php

namespace App\Http\Controllers;

use App\DiagnosisService;
use App\InvoiceDentalService;
use Illuminate\Http\Request;

class DiagnosisServiceController extends Controller
{
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
    public function show(DiagnosisService $diagnosisService)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(DiagnosisService $diagnosisService)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiagnosisService $diagnosisService)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiagnosisService $diagnosisService)
    {
    }

    public function getInvoiceServices(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $services = DiagnosisService::with('items')
            ->where('invoice_id', $invoice_id)->orderBy('id')->get();

        echo json_encode($services);
        exit;
    }

    public function getInvoiceDentalServices(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $services = DiagnosisService::with('items', 'dental')
            ->where('invoice_id', $invoice_id)->orderBy('id')->get();

        echo json_encode($services);
        exit;
    }

    public function findInvoiceDentalService(Request $request)
    {
        $diagnosis_service_id = $request->diagnosis_service_id;
        $dental = InvoiceDentalService::where('diagnosis_service_id', $diagnosis_service_id)->firstOrFail()
        ;

        echo json_encode($dental);
        exit;
    }
}