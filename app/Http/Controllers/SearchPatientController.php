<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Patient;
use Illuminate\Http\Request;

class SearchPatientController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $patients = Patient::query()
            ->whereLike(['full_name', 'insurance_id'], $search)
            ->get()->take(20)
        ;
        $response = [];
        foreach ($patients as $patient) {
            $response[] = [
                'id' => $patient->id,
                'text' => $patient->full_name.' - '.$patient->insurance_id,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function searchPatient(Request $request)
    {
        $search = $request->search;

        $patients = Patient::whereLike(['full_name', 'insurance_id'], $search)
            ->paginate(15)
        ;

        return view('patients.index', compact('patients'));
    }

    public function findPatient(Request $request)
    {
        $patient_id = $request->patient_id;
        $patient = Patient::with('insurer')->where('id', $patient_id)->firstOrFail();
        echo json_encode($patient);
        exit;
    }
}
