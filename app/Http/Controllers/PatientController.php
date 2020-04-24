<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Requests\UpdatePatientRequest;
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

        $patients = Patient::with('insurer')->whereLike(['full_name', 'insurance_id'], $search)
            ->paginate($perPage)
        ;

        return view('patients.index', compact('patients', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurers = Insurer::take(10)->get();

        return view('patients.create', compact('insurers'));
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
        Patient::create($validated);

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
        $insurers = Insurer::get();

        return view('patients.edit', compact('patient', 'insurers'));
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
