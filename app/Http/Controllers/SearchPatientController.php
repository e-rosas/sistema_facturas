<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class SearchPatientController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $patients = Patient::query()
            ->whereLike(['full_name'], $search)
            ->get()->take(20)
        ;
        $response = [];
        foreach ($patients as $patient) {
            $insured = ($patient->insured ? 'Asegurado' : 'Dependiente');
            $response[] = [
                'id' => $patient->id,
                'text' => $patient->full_name.' '.$patient->birth_date->format('M-d-Y').' '.$insured,
                'insured' => $patient->insured,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function searchInsuree(Request $request)
    {
        $search = $request->search;
        $patients = Patient::query($search)
            ->where('insured', 1)
            ->with('insuree.insurer')
            ->where(function ($query) use ($search) {
                $query->whereLike(['full_name', 'insuree.nss'], $search)
                ;
            })
            ->get()->take(20)
        ;
        $response = [];
        foreach ($patients as $patient) {
            $response[] = [
                'id' => $patient->id,
                'text' => $patient->full_name.' - '.$patient->birth_date->format('Y-m-d').' '.$patient->insuree->insurer->name,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function findPatient(Request $request)
    {
        $patient_id = $request->patient_id;
        $patient = Patient::where('id', $patient_id)->firstOrFail();
        echo json_encode($patient);
        exit;
    }

    public function findInsuree(Request $request)
    {
        $patient_id = $request->patient_id;
        $patient = Patient::with('insuree.insurer')->where('id', $patient_id)->firstOrFail();
        echo json_encode($patient);
        exit;
    }
}