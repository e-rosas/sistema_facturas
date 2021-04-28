<?php

namespace App\Actions;
use App\Insurance;
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

}