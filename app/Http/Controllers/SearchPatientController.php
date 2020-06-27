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
            $response[] = [
                'id' => $patient->id,
                'text' => $patient->full_name.' '.$patient->birth_date->format('M-d-Y'),
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
                'text' => $patient->full_name.' - '.$patient->birth_date->format('Y-m-d'),
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
}