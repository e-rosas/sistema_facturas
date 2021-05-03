<?php

namespace App\Http\Controllers;

use App\Actions\PreparePatientLetter;
use App\Actions\SendMailjet;
use App\Campaign;
use App\Http\Requests\CampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Insurance;
use App\PatientLetter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::paginate(20);

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $validated = $request->validated();
        Campaign::create($validated);

        return redirect()->route('campaigns.create')->withStatus(__('Campaña registrada exitosamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $insurance_ids = DB::table('emails')->where('campaign_id', $campaign->id)->pluck('insurance_id')->toArray();

        //dd($insurance_ids);

        $end = Carbon::today()->addDay();
        $start = Carbon::today()->subMonths(1);
        $sentInsurances = DB::table('insurances')->whereIn('id', $insurance_ids)->get();

        $notSentInsurances = DB::table('insurances')->whereNotIn('id', $insurance_ids)->get();

        return view('campaigns.show', compact(['campaign', 'sentInsurances', 'notSentInsurances', 'end', 'start']));
    }

    public function send(Request $request)
    {
        $insurances = Insurance::with('insurer')->whereIn('id', $request->input('insurances'))->get();

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $campaign = Campaign::findOrFail($request->campaign_id);

        $user_id = $request->user()->id;

        $preparePatientLetter = new PreparePatientLetter();

        $mailjet = new SendMailjet();

        foreach ($insurances as $insurance) {
            $insurer = $insurance->insurer;
            if ('pendiente@pendiente.com' != $insurer->email) {
                $patients = $preparePatientLetter->getInsurancePatients($insurance);
                foreach ($patients as $patient) {
                    $invoices = $preparePatientLetter->getInsurancePatientInvoices($insurance, $patient, $start, $end);
                    $letter = $preparePatientLetter->prepareLetter($insurance, $patient, $invoices);
                    if ($mailjet->sendCampaignEmail($campaign, $insurance, $patient, $letter, $user_id)) {
                        $patient_letter = new PatientLetter();
                        $patient_letter->patient_id = $patient->id;
                        $patient_letter->date = Carbon::today();
                        $patient_letter->content = $preparePatientLetter->invoiceContent;
                        $patient->comments = 'Total: '.$preparePatientLetter->invoiceTotal.' Periodo: '.$start->format('M-d-Y').' - '.$end->format('M-d-Y');
                        $patient_letter->status = 0;
                        $patient_letter->save();
                    }
                }
            }
        }

        return redirect()->route('campaigns.show', [$campaign])->withStatus(__('Campaña enviada exitosamente.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $validated = $request->validated();

        $campaign->fill($validated);
        $campaign->save();

        return redirect()->route('campaigns.edit', compact('campaign'))
            ->withStatus(__('Campaña modificada exitosamente.'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
    }
}
