<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Actions\SelectInsurance;
use App\Dependent;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Insurance;
use App\Insuree;
use App\Insurer;
use App\Invoice;
use App\Listeners\UpdatePersonStats;
use App\Patient;
use App\PatientLetter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
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

        $insurees = Insuree::with('patient')->whereLike(['nss', 'patient.full_name'], $search)->paginate($perPage);
        //dd($insurees);
        foreach ($insurees as $insuree) {
            $insuree->dependents = Dependent::with('patient')->where('insuree_id', $insuree->patient_id)
                ->get()
            ;
        }

        /* $patients = Patient::with('insurer')->whereLike(['full_name', 'insurance_id'], $search)
            ->paginate($perPage)
        ; */

        return view('patients.index', compact('insurees', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $insuree = 0;
        if ($request->insuree > 0) {
            $insuree = 1;
            $insurers = Insurer::orderBy('name', 'asc')->get();

            return view('patients.create', compact('insurers', 'insuree'));
        }

        return view('patients.create', compact('insuree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        $validated = $request->validated();
        $validated['full_name'] = $validated['last_name'].' '.$validated['name'];

        $patient = Patient::create($validated);
        if ($validated['insured'] > 0) {
            $insuree = new Insuree();
            $insuree->patient_id = $patient->id;
            $insuree->insurer_id = $validated['insurer_id'];
            $insuree->nss = $validated['insurance_id'];
            $insuree->insurance_id = $validated['insurance_id'];
            $insuree->group_number = $validated['group_number'] ?? '';
            $insurance = new Insurance();

            $insurance->insurance_id = $validated['insurance_id'];

            $insurance->group_number = $validated['group_number'] ?? '';

            //No custom phone_number -> take insurer's number
            if (null == $validated['insurer_phone_number']) {
                $insurer = Insurer::findOrFail($validated['insurer_id']);
                $insurance->group_phone_number = $insurer->phone_number;
            } else {
                $insurance->group_phone_number = $validated['insurer_phone_number'];
            }

            $insuree->save();
            $insurance->insuree_id = $patient->id;
            $insurance->insurer_id = $validated['insurer_id'];
            $insurance->type = $request->type;
            $insurance->status = $request->status;
            $insurance->comments = $request->comments;
            $insurance->save();
        } else {
            $dependent = new Dependent();
            $dependent->patient_id = $patient->id;
            $dependent->insuree_id = $validated['insuree_id'];
            $dependent->relationship = $validated['relationship'];
            $dependent->save();
        }

        return redirect()->route('patients.index')->withStatus(__('Paciente registrado exitosamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $patient->load('person_stats');
        $invoices = Invoice::with('patient', 'payments', 'credit', 'calls')
            ->where('patient_id', $patient->id)
            ->orderBy('date', 'desc')->get();

        $invoices_totals = new CalculateTotalsOfInvoices($invoices);
        $invoices_totals->totals();

        $dependents = [];
        $insurances = [];
        $insurers = [];
        $insuree = 0;

        if ($patient->insured) {
            $dependents = Dependent::with('patient')->where('insuree_id', $patient->id)->get();
            $insurances = Insurance::with('insurer')->where('insuree_id', $patient->id)->get();
            $insurers = Insurer::orderBy('name', 'asc')->get();
        } else {
            $insuree = Insuree::with('patient', 'insurer')
                ->where('patient_id', $patient->dependent->insuree_id)
                ->first()
            ;
        }

        $letters = PatientLetter::where('patient_id', $patient->id)->orderBy('date', 'desc')->get();


        $end = Carbon::today()->addDay();
        $start = Carbon::today()->subMonths(1);

        return view('patients.show', compact('patient', 'invoices', 'invoices_totals',  'dependents', 'insuree', 'end', 'start', 'letters', 'insurances', 'insurers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        if ($patient->insured) {
            $insurers = Insurer::get();

            return view('patients.edit', compact('patient', 'insurers'));
        }

        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Patient $patient, UpdatePatientRequest $request)
    {
        $validated = $request->validated();
        $validated['full_name'] = $validated['last_name'].' '.$validated['name'];
        $patient->fill($validated);
        if ($patient->insured) {
            //$insuree = Insuree::where('patient_id', $patient->id)->first();
            $patient->insuree->insurer_id = $validated['insurer_id'];
            $patient->insuree->insurance_id = $validated['insurance_id'];
            $patient->insuree->group_number = $validated['group_number'];
            $patient->insuree->insurer_phone_number = $validated['insurer_phone_number'];

            $patient->insuree->save();
            $dependents = Dependent::with('patient')->where('insuree_id', $patient->id)->get();
            foreach ($dependents as $dependent) {
                $dependent->patient->street = $patient->street;
                $dependent->patient->street_number = $patient->street_number;
                $dependent->patient->city = $patient->city;
                $dependent->patient->state = $patient->state;
                $dependent->patient->zip_code = $patient->zip_code;
                $dependent->patient->phone_number = $patient->phone_number;
                $dependent->patient->save();
            }
        } else {
            //$dependent = Dependent::where('patient_id', $patient->id)->first();
            $patient->dependent->relationship = $validated['relationship'];
            $patient->dependent->save();
        }
        $patient->save();

        return redirect()->route('patients.index')->withStatus(__('Datos de paciente modificados exitosamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->withStatus(__('Paciente eliminado exitosamente.'));
    }

    public function updateStats()
    {
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $stats = new UpdatePersonStats();
            $stats->updateStats($patient->id);
        }
    }

    public function migrateInsurance()
    {
        $insureds = Insuree::all();
        foreach ($insureds as $insured) {
            $insurance = new Insurance();
            $insurance->insuree_id = $insured->patient_id;
            $insurance->insurer_id = $insured->insurer_id;
            $insurance->group_phone_number = $insured->insurer_phone_number;
            $insurance->group_number = $insured->group_number;
            $insurance->insurance_id = $insured->insurance_id;
            $insurance->type = 0;
            $insurance->status = 0;
            $insurance->comments = '';
            $insurance->save();
        }
    }

    public function addInsuranceToInvoices()
    {
        $patients = Patient::all();
        $selectInsurance = new SelectInsurance();
        foreach ($patients as $patient) {
            $insurance = $selectInsurance->activeInsurance2($patient);
            DB::table('invoices')
                ->where('patient_id', $patient->id)
                ->update(['insurance_id' => $insurance->id])
            ;
        }
    }
}
