<?php

namespace App\Http\Controllers;

use App\InvoiceDiagnosis;
use App\InvoiceDiagnosisList;
use Illuminate\Http\Request;

class InvoiceDiagnosisController extends Controller
{
    public function getInvoiceDiagnoses(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $diagnoses = InvoiceDiagnosisList::with('services.items')
            ->where('invoice_diagnoses_id', $invoice_id)->get();

        echo json_encode($diagnoses);
        exit;
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
