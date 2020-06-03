<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\Http\Requests\DiagnosisRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\InvoiceDiagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
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

        $diagnoses = Diagnosis::whereLike(['code', 'name', 'nombre'], $search)->paginate($perPage);

        return view('diagnoses.index', compact('diagnoses', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diagnoses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DiagnosisRequest $request)
    {
        $validated = $request->validated();
        Diagnosis::create($validated);

        return redirect()->route('diagnoses.index')->withStatus(__('Diagnóstico registrado exitosamente'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosis $diagnosis)
    {
    }

    public function updateCodes()
    {
        $all = InvoiceDiagnosis::all();
        foreach ($all as $diagnosis) {
            $diagnosis->diagnosis_code = $diagnosis->diagnosis->code;
            $diagnosis->save();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosis $diagnosis)
    {
        return view('diagnoses.edit', compact('diagnosis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiagnosisRequest $request, Diagnosis $diagnosis)
    {
        $validated = $request->validated();
        $diagnosis->fill($validated);
        $diagnosis->save();

        return redirect()->route('diagnoses.index')->withStatus(__('Diagnóstico actualizado exitosamente'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
    }
}
