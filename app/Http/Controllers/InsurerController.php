<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Dependent;
use App\Http\Requests\InsurerRequest;
use App\Http\Requests\UpdateInsurer;
use App\Insuree;
use App\Insurer;
use App\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InsurerController extends Controller
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

        if (!is_null($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $insurers = Insurer::whereLike('name', $search)->paginate($perPage);

        return view('insurers.index', compact('insurers', 'search', 'perPage'));
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
    public function show(Insurer $insurer, Request $request)
    {
        if (!is_null($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }
        if (!empty($request['start'] && !empty($request['end']))) {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
        } else {
            $end = Carbon::today()->addDay();
            $start = Carbon::today()->subMonths(6);
        }

        $insurees = Insuree::with('patient')->where('insurer_id', $insurer->id)
            ->whereLike(['nss', 'insurance_id', 'patient.full_name'], $search)
            ->paginate(10)
        ;

        //dd($insurees);

        /* foreach ($insurees as $insuree) {
            $insuree->dependents = Dependent::with('patient')->where('insuree_id', $insuree->patient_id)
                ->get()
            ;
        } */

        /* foreach ($insurees as $insuree) {
            $invoicess = Invoice::with('payments', 'patient', 'credit')
                ->where('patient_id', $insuree->patient_id)->get();
            foreach ($invoicess as $invoice) {
                $invoices->add($invoice);
            }
        }
        $invoices_totals = new CalculateTotalsOfInvoices($invoices);
        $invoices_totals->totals(); */
        /* foreach ($insurer->insurees as $insuree) {
            foreach ($insuree->patient->invoices as $invoice) {
                $invoice->load('payments', 'credit');
                $invoices[] = $invoice;
            }
        } */

        return view('insurers.show', compact('insurer', 'insurees', 'search','start', 'end'));
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
        $insurer->delete();
        return redirect()->route('insurers.index')->withStatus(__('Aseguranza eliminada exitosamente.'));
    }

    public function find(Request $request)
    {
        $insurer_id = $request->insurer_id;
        $insurer = Insurer::findOrFail($insurer_id);

        echo json_encode($insurer);
        exit;
    }
}