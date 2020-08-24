<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalsOfInvoices;
use App\Http\Requests\ReportRequest;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request['start'] && !empty($request['end']))) {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
        } else {
            $end = Carbon::today()->addDay();
            $start = Carbon::today()->subMonths(6);
        }

        if (!is_null($request->perPage)) {
            $perPage = $request->perPage;
        } else {
            $perPage = 15;
        }

        if (is_null($request['payment'])) {
            $payment = 3;
        } else {
            $payment = $request['payment'];
        }

        if (is_null($request['registered'])) {
            $registered = -1;
        } else {
            $registered = $request['registered'];
        }

        if (1 == $payment) {
            $invoices = Invoice::with('payments', 'patient', 'credit')
                ->where([['amount_paid', 0]])
                ->whereBetween('date', [$start, $end])
                ->orderBy('number', 'asc')
                ->paginate($perPage)

        ;
        } elseif (2 == $payment) {
            $invoices = Invoice::with('payments', 'patient', 'credit')
                ->where([['amount_paid', '>', 0]])
                ->whereBetween('date', [$start, $end])
                ->orderBy('number', 'asc')
                ->paginate($perPage)

        ;
        } else {
            $invoices = Invoice::with('payments', 'patient', 'credit')
                // ->where('registered', '>=', $registered)
                ->whereBetween('date', [$start, $end])
                ->orderBy('number', 'asc')
                ->paginate($perPage)

        ;
        }

        $invoices_totals = new CalculateTotalsOfInvoices($invoices);
        $invoices_totals->totals();

        return view('reports.index', compact('end', 'start', 'perPage', 'invoices', 'invoices_totals', 'payment', 'registered'));
    }

    public function payments(ReportRequest $request)
    {
        /* $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date); */

        $validated = $request->validated();

        $fromDate = $validated['start_date'];
        $toDate = $validated['end_date'];

        $payments = DB::table('payments')
            ->select(['date', DB::raw('(COUNT(*)) as total_payments'),  DB::raw('(SUM(amount)) as total_amount_paid')])
            ->orderBy('date')
            ->groupBy(DB::raw('MONTH(date)'))
            ->havingRaw(
                '(date >= ? AND date <= ?)',
                [$fromDate.' 00:00:00', $toDate.' 23:59:59']
            )
            ->get()
        ;

        foreach ($payments as $payment) {
            $date = new Carbon($payment->date);
            $payment->date = $date->format('M-y');
        }

        return json_encode($payments);
    }

    public function invoiceStats(ReportRequest $request)
    {
        /* $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date); */

        $validated = $request->validated();

        $fromDate = $validated['start_date'];
        $toDate = $validated['end_date'];

        $invoices = DB::table('invoices')
            ->select([DB::raw("DATE_FORMAT(date, '%m-%y') AS month"), DB::raw('(COUNT(id)) as total_invoices'),
                DB::raw('(SUM(amount_paid)) as total_amount_paid'),
                DB::raw('(SUM(amount_due)) as total_amount_due'),
                DB::raw('(SUM(amount_credit)) as total_amount_credit'),
                DB::raw('(SUM(total_with_discounts)) as total'), ])
            ->whereRaw(
                '(date >= ? AND date <= ? AND registered=1)',
                [$fromDate.' 00:00:00', $toDate.' 23:59:59']
            )
            ->orderBy('date')
            ->groupBy(DB::raw("DATE_FORMAT(date, '%M-%y')"))

            ->get()
        ;

        /* foreach ($invoices as $invoice) {
            $date = new Carbon($invoice->date);
            $invoice->date = $date->format('M-y');
        } */

        /* $payments = DB::table('payments')
            ->select(['date', DB::raw('(COUNT(*)) as total_payments'),  DB::raw('(SUM(amount)) as total_amount_paid')])
            ->orderBy('date')
            ->groupBy(DB::raw('MONTH(date)'))
            ->havingRaw(
                '(date >= ? AND date <= ?)',
                [$fromDate.' 00:00:00', $toDate.' 23:59:59']
            )
            ->get()
        ;

        foreach ($payments as $payment) {
            $date = new Carbon($payment->date);
            $payment->date = $date->format('M-y');
        } */

        return json_encode($invoices);
    }

    public function stats(Request $request)
    {
        /* $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date); */

        $stats = [];

        $personal_stats = DB::table('person_stats')
            ->select([DB::raw('(SUM(personal_amount_due)) as personal_amount_due'),
                DB::raw('(SUM(amount_paid)) as amount_paid'), ])
            ->where('status', 1)
            ->get()
        ;

        $insurance_stats = DB::table('person_stats')
            ->select([DB::raw('(SUM(amount_due)) as amount_due'),
                DB::raw('(SUM(amount_paid)) as amount_paid'), ])
            ->where('status', 0)
            ->get()
        ;
        array_push($stats, $personal_stats, $insurance_stats);

        return json_encode($stats);
    }
}