<?php

namespace App\Http\Controllers;

use App\Call;
use App\Http\Requests\UpdateCallRequest;
use App\Http\Resources\CallResource;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calls = Call::with('invoice')
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return view('calls.index', compact('calls'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateCall();
        $validated['number'] = 'C'.$validated['invoice_id'].'-'.rand(1, 1000);
        Call::create($validated);

        return $this->invoiceCalls($request->invoice_id);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCallRequest $request)
    {
        $validated = $request->validated();
        $id = $request->id;

        $call = Call::findOrFail($id);
        $call->fill($validated);
        $call->save();

        return $this->invoiceCalls($call->invoice_id);
    }

    public function delete(Request $request)
    {
        $call = Call::findOrFail($request['call_id']);
        $invoice_id = $call->invoice_id;
        $call->delete();

        return $this->invoiceCalls($invoice_id);
    }

    public function validateCall()
    {
        return request()->validate(Call::$rules);
    }

    public function find(Request $request)
    {
        $call = Call::findOrFail($request->id);

        CallResource::withoutWrapping();

        return new CallResource($call);
    }

    private function invoiceCalls($invoice_id)
    {
        $calls = Call::where('invoice_id', $invoice_id)
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return CallResource::collection($calls);
    }
}
