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
        $credits = Credit::with('invoice')
            ->whereLike(['number', 'invoice.code', 'invoice.number'], $search)
            ->orderBy('date', 'desc')
            ->paginate($perPage)
        ;

        return view('credits.index', compact('credits', 'search', 'perPage'));
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
        if (1 != $invoice->type && (0 == $invoice->status)) { //different than one unique payment
            $validated['number'] = $validated['invoice_number'].'- NC'.rand(1, 1000);
            event(new InvoiceEvent($invoice)); //update invoice stats BEFORE
            $validated['amount_due'] = $invoice->amount_due;
            $invoice->amount_due = 0;
            $credit = Credit::create($validated);
            $invoice->status = 1;
            $invoice->type = 0;
            $invoice->save();
            event(new InvoiceEvent($invoice)); //AFTER

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