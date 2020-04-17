<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Events\InvoiceEvent;
use App\Http\Requests\CreditRequest;
use App\Http\Resources\CreditResource;
use App\Invoice;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = Credit::with('invoice')
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return view('credits.index', compact('credits'));
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
    public function store(CreditRequest $request)
    {
        $validated = $request->validated();
        $invoice = Invoice::where('id', $validated['invoice_id'])->first();
        if (1 != $invoice->type && (0 == $invoice->status)) { //different than one unique payment, and
            $validated['number'] = $validated['invoice_number'].'- P'.rand(1, 1000);
            event(new InvoiceEvent($invoice)); //update invoice stats
            $validated['amount_due'] = $invoice->amount_due;
            $credit = Credit::create($validated);
            $invoice->status = 1;
            $invoice->type = 0;
            $invoice->save();

            return new CreditResource($credit);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
    }
}
