<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Http\Requests\InsurerRequest;
use App\Http\Requests\UpdateInsurer;
use App\Insuree;
use App\Insurer;
use App\Invoice;
use Illuminate\Http\Request;

class InsurerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurers = Insurer::paginate();

        return view('insurers.index', compact('insurers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insurers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InsurerRequest $request)
    {
        $validated = $request->validated();
        Insurer::create($validated);

        return redirect()->route('insurers.index')->withStatus(__('Asegurada registrada exitosamentes.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Insurer $insurer)
    {
        $invoices = collect();

        $insurees = Insuree::where('insurer_id', $insurer->id)->get();
        foreach ($insurees as $insuree) {
            $invoicess = Invoice::with('payments', 'patient', 'credit')
                ->where('patient_id', $insuree->patient_id)->get();
            foreach ($invoicess as $invoice) {
                $invoices->add($invoice);
            }
        }
        $invoices_totals = new CalculateTotalsOfInvoices($invoices);
        $invoices_totals->totals();
        /* foreach ($insurer->insurees as $insuree) {
            foreach ($insuree->patient->invoices as $invoice) {
                $invoice->load('payments', 'credit');
                $invoices[] = $invoice;
            }
        } */

        return view('insurers.show', compact('insurer', 'invoices', 'invoices_totals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Insurer $insurer)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsurer $request)
    {
        $validated = $request->validated();
        $insurer = Insurer::findOrFail($validated['insurer_id']);

        $insurer->fill($validated);
        $insurer->save();

        return response('OK', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurer $insurer)
    {
    }

    public function find(Request $request)
    {
        $insurer_id = $request->insurer_id;
        $insurer = Insurer::findOrFail($insurer_id);

        echo json_encode($insurer);
        exit;
    }
}
