<?php

namespace App\Http\Controllers;

use App\InvoiceService;
use Illuminate\Http\Request;

class InvoiceServiceController extends Controller
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
    public function show(InvoiceService $invoiceService)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceService $invoiceService)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceService $invoiceService)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceService $invoiceService)
    {
    }

    public function getInvoiceServices(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $services = InvoiceService::where('invoice_id',  $invoice_id)->get();

        echo json_encode($services);
        exit;
    }
}
