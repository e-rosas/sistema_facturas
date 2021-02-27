<?php

namespace App\Http\Controllers;

use App\Actions\VerifyPaymentAmount;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
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

        if (is_null($request['search'])) {
            $search = '';
        } else {
            $search = $request['search'];
        }
        $payments = Payment::with('invoice')
            ->whereBetween('date', [$start, $end])
            ->whereLike(['number', 'invoice.code', 'invoice.number'], $search)
            ->orderBy('date', 'desc')
            ->paginate($perPage)
        ;

        return view('payments.index', compact('payments', 'search', 'perPage', 'end', 'start'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $validated = $request->validated();

        //New action: Verify that paid amount does not exceed due amount
        $validatePayment = new VerifyPaymentAmount($validated['amount_paid'], $validated['invoice_id']);
        $concept = $validatePayment->verifyPayment();
        if ('' == $validated['number']) {
            $validated['number'] = 'Pendiente'; //$validated['invoice_number'].'- P'.rand(1, 1000);
        }

        if ($concept < 2) {
            $validated['type'] = $validatePayment->paymentType();
            $validated['concept'] = $concept;
            Payment::create($validated);
        }

        $payments = Payment::with('invoice')
            ->where('invoice_id', $request->invoice_id)
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return PaymentResource::collection($payments);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request)
    {
        $validated = $request->validated();
        $id = $validated['payment_id'];
        $payment = Payment::findOrFail($id);

        $validatePayment = new VerifyPaymentAmount($validated['amount_paid'], $payment->invoice_id);
        $concept = $validatePayment->verifyUpdatePayment($payment->amount_paid);

        if ($concept < 2) {
            if (is_null($validated['number'])) {
                $validated['number'] = $validated['invoice_number'].'- P'.rand(1, 10000);
            }
            $payment->fill($validated);
            $payment->save();
        }

        $payments = Payment::with('invoice')
            ->where('invoice_id', $payment->invoice_id)
            ->orderBy('date', 'desc')
            ->paginate(25)
        ;

        return PaymentResource::collection($payments);
    }

    public function delete(Request $request)
    {
        $payment = Payment::find($request['payment_id']);
        $invoice_id = $payment->invoice_id;
        $validatePayment = new VerifyPaymentAmount($payment->amount_paid, $invoice_id);
        if ($validatePayment->verifyDeletePayment()) {
            $payment->delete();
        }

        $payments = Payment::with('invoice')->where('invoice_id', $invoice_id)
            ->orderBy('date', 'desc')
            ->paginate(25)
        ;

        return PaymentResource::collection($payments);
    }

    public function find(Request $request)
    {
        $payment = Payment::findOrFail($request->payment_id);

        return new PaymentResource($payment);
    }
}