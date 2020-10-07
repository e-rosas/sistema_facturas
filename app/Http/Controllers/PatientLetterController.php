<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePatientLetterRequest;
use App\Http\Resources\PatientLetterResource;
use App\PatientLetter;
use Illuminate\Http\Request;

class PatientLetterController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientLetterRequest $request)
    {
        $validated = $request->validated();
        $id = $request->id;

        $letter = PatientLetter::findOrFail($id);
        $letter->fill($validated);
        $letter->save();

        $letters = PatientLetter::where('patient_id', $letter->patient_id)
            ->orderBy('date', 'desc')
            ->get()
        ;

        return PatientLetterResource::collection($letters);
    }

    public function find(Request $request)
    {
        $letter = PatientLetter::findOrFail($request->letter_id);

        return new PatientLetterResource($letter);
    }
}