<?php

namespace App\Http\Controllers;

use App\Call;
use App\Http\Requests\UpdateCallRequest;
use App\Http\Resources\CallResource;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CallController extends Controller
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
        if (is_null($request['status'])) {
            $status = 6;
        } else {
            $status = $request['status'];
        }

        if ($status < 6) {
            $invoices = Invoice::with('calls')
                ->where('status', $status)
                ->whereBetween('date', [$start, $end])
                ->whereLike(['code'], $search)
                ->orderBy('date', 'asc')
                ->paginate($perPage)
            ;
        } else {
            $invoices = Invoice::with('calls')
                ->whereBetween('date', [$start, $end])
                ->whereLike(['code'], $search)
                ->orderBy('date', 'asc')
                ->paginate($perPage)
        ;
        }

        return view('calls.index', compact('invoices', 'search', 'perPage', 'status', 'end', 'start'));
        /* if (!is_null($request->perPage)) {
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
        if (is_null($request['status'])) {
            $status = 6;
        } else {
            $status = $request['status'];
        }

        if ($status < 6) {
            $calls = Call::with('invoice')
                ->where('status', $status)
                ->whereBetween('date', [$start, $end])
                ->whereLike(['number', 'invoice.code', 'comments'], $search)
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        } else {
            $calls = Call::with('invoice')
                ->whereBetween('date', [$start, $end])
                ->whereLike(['number', 'invoice.code', 'comments'], $search)
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        }

        return view('calls.index', compact('calls', 'search', 'perPage', 'status', 'end', 'start')); */
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

        $status = $validated['status'];

        if (0 != $status || 0 != $status) {
            $invoice = Invoice::findOrFail($validated['invoice_id']);
            if (1 != $invoice->status) {
                $invoice->status = 5;
                $invoice->save();
            }
        }

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

        $status = $validated['status'];

        if (0 != $status || 0 != $status) {
            $invoice = Invoice::findOrFail($validated['invoice_id']);
            $invoice->status = 5;
            $invoice->save();
        }

        return $this->invoiceCalls($call->invoice_id);
    }

    public function delete(Request $request)
    {
        $call = Call::findOrFail($request['call_id']);
        $invoice_id = $call->invoice_id;
        $call->delete();

        $invoice = Invoice::findOrFail($invoice_id);
        $invoice->status = 5;
        $invoice->save();

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