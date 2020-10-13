<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePatientLetterRequest;
use App\Http\Resources\PatientLetterResource;
use App\PatientLetter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientLetterController extends Controller
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

        if (!empty($request['start'] && !empty($request['end']))) {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
        } else {
            $end = Carbon::today()->addDay();
            $start = Carbon::today()->subMonths(3);
        }

        if (is_null($request['status'])) {
            $status = 2;
        } else {
            $status = $request['status'];
        }

        if (is_null($request['search'])) {
            $search = '';
        } else {
            $search = $request['search'];
        }

        if ($status < 2) {
            $letters = PatientLetter::with('patient')
                ->where('status', $status)
                ->whereBetween('date', [$start, $end])
                ->whereLike(['patient.full_name'], $search)
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        } else {
            $letters = PatientLetter::with('patient')
                ->whereBetween('date', [$start, $end])
                ->whereLike(['patient.full_name'], $search)
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        }

        return view('emails.index', compact('letters', 'search', 'perPage', 'status', 'start', 'end'));
    }

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

    public function delete(Request $request)
    {
        $letter = PatientLetter::find($request['letter_id']);
        $patient_id = $letter->patient_id;
        $letter->delete();

        $letters = PatientLetter::where('patient_id', $patient_id)
            ->orderBy('date', 'desc')
            ->get()
        ;

        return PatientLetterResource::collection($letters);
    }
}