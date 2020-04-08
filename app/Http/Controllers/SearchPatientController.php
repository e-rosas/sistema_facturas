<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Insuree;
use App\PersonData;
use Illuminate\Http\Request;

class SearchPatientController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $patients = PersonData::query()
            ->whereLike(['full_name'], $search)
            ->get()->take(25)
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

    public function searchInsuree(Request $request)
    {
        $search = $request->search;
        $patients = PersonData::query($search)
            ->where('insured', 1)
            ->where(function ($query) use ($search) {
                $query->whereLike(['full_name'], $search)
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

    public function searchInsureeIndex(Request $request)
    {
        $search = $request->search;

        $insurees = Insuree::whereLike(['person_data.full_name', 'insurance_id'], $search)
            ->paginate(10)
        ;

        return view('insurees.index', compact('insurees'));
    }

    public function searchBeneficiary(Request $request)
    {
        $search = $request->search;
        $beneficiaries = Beneficiary::whereLike(['person_data.full_name'], $search)
            ->paginate(10)
        ;

        return view('beneficiaries.index', compact('beneficiaries'));
    }

    public function findBeneficiary(Request $request)
    {
        $person_data_id = $request->person_data_id;
        $beneficiary = Beneficiary::with('person_data', 'insuree')->where('person_data_id', '=', $person_data_id)->firstOrFail();

        echo json_encode($beneficiary);
        exit;
    }

    public function findInsuree(Request $request)
    {
        $person_data_id = $request->person_data_id;
        $insuree = Insuree::with('person_data', 'insurer')->where('person_data_id', '=', $person_data_id)->firstOrFail();
        echo json_encode($insuree);
        exit;
    }
}
