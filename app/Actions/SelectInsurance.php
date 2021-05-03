<?php

namespace App\Actions;

use App\Dependent;
use App\Insurance;
use App\Patient;
use Illuminate\Support\Facades\DB;

class SelectInsurance {

    public function deactivateInsurances($insuree_id, $insurance_id)
    {
        //mark as inactive other insurances
        $insurances = DB::table('insurances')
        ->where('insuree_id', $insuree_id)
        ->where('id', '!=', $insurance_id)
        ->update(['status' => 1]);
    }

    public function activeInsurance($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        if($patient->insured) {
            return Insurance::where('insuree_id', $patient_id)->where('status', 0)->first();
        } else {
            $dependent = Dependent::where('patient_id', $patient_id)->first();
            return Insurance::where('insuree_id', $dependent->insuree_id)->where('status', 0)->first();
        }
    }

    public function patientInsurances(Patient $patient)
    {
        $insurances = Insurance::with('insurer');
        if($patient->insured) {
            $insurances->where('insuree_id', $patient->id);
        } else {
            $dependent = Dependent::where('patient_id', $patient->id)->first();
            $insurances->where('insuree_id', $dependent->insuree_id);
        }

        return $insurances->get();
    }

    public function activeInsurance2(Patient $patient)
    {
        if($patient->insured) {
            return Insurance::where('insuree_id', $patient->id)->where('status', 0)->first();
        } else {
            $dependent = Dependent::where('patient_id', $patient->id)->first();
            return Insurance::where('insuree_id', $dependent->insuree_id)->where('status', 0)->first();
        }
    }

}