<?php

namespace App\Http\Controllers;

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
            $insuree->dependents = Dependent::with('patient')->where('insuree_id', $insuree->id)->get();
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
        print_r($validated);
        $validated['full_name'] = $validated['last_name'].' '.$validated['name'];

        $patient = Patient::create($validated);
        if ($validated['insured'] > 0) {
            $insuree = new Insuree();
            $insuree->patient_id = $patient->id;
            $insuree->insurer_id = $validated['insurer_id'];
            $insuree->insurance_id = $validated['insurance_id'];
            $insuree->nss = $validated['nss'];
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
        $invoices = Invoice::with('services')
            ->where('patient_id', $patient->id)
            ->paginate(5)
        ;

        return view('patients.show', compact('patient', 'invoices'));
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
            $patient->insuree->insurer_id = $validated['insurer_id'];
            $patient->insuree->insurance_id = $validated['insurance_id'];
            $patient->insuree->save();
        } else {
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
