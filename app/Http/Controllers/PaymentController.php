<?php

namespace App\Http\Controllers;

use App\Actions\VerifyPaymentAmount;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('invoice')
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $validated = $request->validated();

        //New action: Verify that paid amount does not exceed due amount
        $validatePayment = new VerifyPaymentAmount($validated['amount_paid'], $validated['invoice_id']);
        if($validatePayment->verifyPayment()){
            $validated['number'] = $validated['invoice_number'] .'- P' . rand(1, 1000);
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
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
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
        if($validatePayment->verifyPayment()){
            $payment->fill($validated);
            $payment->save();
        }
        

        $payments = Payment::with('invoice')
            ->where('invoice_id', $payment->invoice_id)
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return PaymentResource::collection($payments);
    }
    public function delete(Request $request)
    {
        $payment = Payment::find($request['payment_id']);
        $invoice_id = $payment->invoice_id;
        $payment->delete();

        $payments = Payment::with('invoice')->where('invoice_id', $invoice_id)
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return PaymentResource::collection($payments);
    }
    public function find(Request $request)
    {
        $payment = Payment::findOrFail($request->payment_id);

        return new PaymentResource($payment);
    }

}
