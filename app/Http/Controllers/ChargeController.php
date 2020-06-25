<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Events\InvoiceEvent;
use App\Http\Requests\ChargeRequest;
use App\Http\Resources\ChargeResource;
use App\Invoice;
use Illuminate\Http\Request;

class ChargeController extends Controller
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
        $charges = Charge::with('invoice')
            ->whereLike(['number', 'invoice.code', 'invoice.number'], $search)
            ->orderBy('date', 'desc')
            ->paginate($perPage)
        ;

        return view('charges.index', compact('charges', 'search', 'perPage'));
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
    public function store(ChargeRequest $request)
    {
        $validated = $request->validated();
        $invoice = Invoice::findOrFail($validated['invoice_id']);
        if ($invoice->amount_due >= $validated['amount_charged']) {
            $validated['number'] = $validated['invoice_number'].'- C'.rand(1, 10000);
            $validated['status'] = 0;
            event(new InvoiceEvent($invoice)); //update invoice stats
            $validated['original_amount_due'] = $invoice->amount_due;
            $charge = Charge::create($validated);
            $invoice->status = 5; //insurance won't pay
            $invoice->save();

            return new ChargeResource($charge);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Charge $charge)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Charge $charge)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Charge $charge)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charge $charge)
    {
    }
}