<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Dependent;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Insuree;
use App\Insurer;
use App\Invoice;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
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

        $insurees = Insuree::with('patient', 'insurer')->whereLike(['nss', 'insurance_id', 'patient.full_name'], $search)->paginate($perPage);

        foreach ($insurees as $insuree) {
            $insuree->dependents = Dependent::with('patient')->where('insuree_id', $insuree->patient_id)
                ->get()
            ;
        }

        /* $patients = Patient::with('insurer')->whereLike(['full_name', 'insurance_id'], $search)
            ->paginate($perPage)
        ; */

        return view('patients.index', compact('insurees', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $insuree = 0;
        if ($request->insuree > 0) {
            $insuree = 1;
            $insurers = Insurer::take(10)->get();

            return view('patients.create', compact('insurers', 'insuree'));
        }

        return view('patients.create', compact('insuree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        $validated = $request->validated();
        $validated['full_name'] = $validated['last_name'].' '.$validated['name'];

        $patient = Patient::create($validated);
        if ($validated['insured'] > 0) {
            $insuree = new Insuree();
            $insuree->patient_id = $patient->id;
            $insuree->insurer_id = $validated['insurer_id'];
            $insuree->insurance_id = $validated['insurance_id'];
            $insuree->nss = $validated['insurance_id'];
            $insuree->save();
        } else {
            $dependent = new Dependent();
            $dependent->patient_id = $patient->id;
            $dependent->insuree_id = $validated['insuree_id'];
            $dependent->relationship = $validated['relationship'];
            $dependent->save();
        }

        return redirect()->route('patients.index')->withStatus(__('Paciente registrado exitosamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $invoices = Invoice::with('patient', 'payments', 'credit', 'calls')
            ->where('patient_id', $patient->id)->get();

        $invoices_totals = new CalculateTotalsOfInvoices($invoices);
        $invoices_totals->totalsShort();

        $calls = [];
        $payments = [];
        $dependents = [];
        $insuree = 0;

        if ($patient->insured) {
            $dependents = Dependent::with('patient')->where('insuree_id', $patient->id)->get();
        } else {
            $insuree = Insuree::with('patient', 'insurer')
                ->where('patient_id', $patient->dependent->insuree_id)
                ->first()
            ;
        }

        foreach ($invoices as $invoice) {
            foreach ($invoice->calls as $call) {
                array_push($calls, $call);
            }

            foreach ($invoice->payments as $payment) {
                array_push($payments, $payment);
            }
        }

        return view('patients.show', compact('patient', 'invoices', 'invoices_totals', 'calls', 'payments', 'dependents', 'insuree'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        if ($patient->insured) {
            $insurers = Insurer::take(10)->get();

            return view('patients.edit', compact('patient', 'insurers'));
        }

        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Patient $patient, UpdatePatientRequest $request)
    {
        $validated = $request->validated();
        $patient->fill($validated);
        if ($patient->insured) {
            //$insuree = Insuree::where('patient_id', $patient->id)->first();
            $patient->insuree->insurer_id = $validated['insurer_id'];
            $patient->insuree->insurance_id = $validated['insurance_id'];
            $patient->insuree->save();
            $dependents = Dependent::with('patient')->where('insuree_id', $patient->id)->get();
            foreach ($dependents as $dependent) {
                $dependent->patient->street = $patient->street;
                $dependent->patient->street_number = $patient->street_number;
                $dependent->patient->city = $patient->city;
                $dependent->patient->state = $patient->state;
                $dependent->patient->zip_code = $patient->zip_code;
                $dependent->patient->phone_number = $patient->phone_number;
                $dependent->patient->save();
            }
        } else {
            //$dependent = Dependent::where('patient_id', $patient->id)->first();
            $patient->dependent->relationship = $validated['relationship'];
            $patient->dependent->save();
        }
        $patient->save();

        return redirect()->route('patients.index')->withStatus(__('Datos de paciente modificados exitosamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
    }
}
