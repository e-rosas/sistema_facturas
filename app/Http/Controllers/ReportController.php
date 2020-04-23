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
        if (!is_null($request['start_date'] && !is_null($request['end_date']))) {
            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
        } else {
            $end = Carbon::today()->addDay();
            $start = Carbon::today()->subMonths(1);
        }

        if (!is_null($request->perPage)) {
            $perPage = $request->perPage;
        } else {
            $perPage = 15;
        }

        $invoices = Invoice::with('payments', 'patient', 'credit')
            ->whereBetween('date', [$start, $end])
            ->paginate($perPage)
        ;

        $invoices_totals = new CalculateTotalsOfInvoices($invoices);
        $invoices_totals->totals();
        /* $personal_stats = DB::table('person_stats')
            ->select([DB::raw('(SUM(personal_amount_due)) as personal_amount_due'),
        DB::raw('(SUM(amount_paid)) as amount_paid'), DB::raw('(SUM(total_amount_due)) as total'), ])
            ->where('status', 1)
            ->get()
        ;

        $insurance_stats = DB::table('person_stats')
            ->select([DB::raw('(SUM(amount_due)) as amount_due'),
        DB::raw('(SUM(amount_paid)) as amount_paid'), DB::raw('(SUM(total_amount_due)) as total'), ])
            ->where('status', 0)
            ->get()
        ;

        $stats['personal_amount_due'] = $personal_stats[0]->personal_amount_due;
        $stats['insurance_amount_due'] = $insurance_stats[0]->amount_due;
        $stats['total_amount_paid'] = $personal_stats[0]->amount_paid + $insurance_stats[0]->amount_paid;
        $stats['total_amount_due'] = $personal_stats[0]->total + $insurance_stats[0]->total - $stats['total_amount_paid']; */

        return view('reports.index', compact('end', 'start', 'perPage', 'invoices', 'invoices_totals'));
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
