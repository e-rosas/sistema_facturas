<?php

namespace App\Http\Controllers;

use App\Actions\PreparePatientLetter;
use App\Actions\SelectInsurance;
use App\Http\Requests\AddInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Http\Requests\UpdateInsurer;
use App\Http\Resources\InsuranceResource;
use App\Insurance;
use App\Insuree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddInsuranceRequest $request)
    {
        $validated = $request->validated();
        $insurance = Insurance::create($validated);
        if($validated['status'] == 0) {
            $deactivate = new SelectInsurance();
            $deactivate->deactivateInsurances($validated['insuree_id'], $insurance->id);
        }

        return $this->insureeInsurances($insurance->insuree_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function show(Insurance $insurance)
    {
        $insuree = Insuree::with('patient')->where('patient_id', $insurance->insuree_id)->first();
        $prepare = new PreparePatientLetter();
        $patients = $prepare->getInsurancePatients($insurance);
        $invoices = $prepare->getInsuranceInvoices($insurance);

        return view('insurances.show', compact('insuree', 'insurance', 'patients', 'invoices'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsuranceRequest $request)
    {
        $validated = $request->validated();
        $id = $request->id;

        $insurance = Insurance::findOrFail($id);
        $insurance->fill($validated);
        $insurance->save();

        return $this->insureeInsurances($insurance->insuree_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $insurance = Insurance::findOrFail($id);
        $insurances = DB::table('insurances')->where('insuree_id', $insurance->insuree_id)->count();
        if($insurances > 1) {
            $insurance->delete();
        }
        

        return $this->insureeInsurances($insurance->insuree_id);
    }

    public function find(Request $request)
    {
        
        $id = $request->id;

        $insurance = Insurance::findOrFail($id);

        return new InsuranceResource($insurance);
    }

    public function select(Request $request)
    {
        $id = $request->id;

        $insurance = Insurance::findOrFail($id);
        $insurance->status = 0;
        $insurance->save();

        $deactivate = new SelectInsurance();
        $deactivate->deactivateInsurances($insurance->insuree_id, $insurance->id);

        return $this->insureeInsurances($insurance->insuree_id);

    }
    private function insureeInsurances($insuree_id)
    {
        $insurances = Insurance::where('insuree_id', $insuree_id)
            ->orderBy('status')
            ->get()
        ;

        return InsuranceResource::collection($insurances);
    }
}
