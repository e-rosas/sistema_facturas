<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function rate(RateRequest $request)
    {
        $validated = $request->validated();
        $invoice_date = $validated['date'];
        $value = $this->findRate($invoice_date);

        return json_encode($value);
    }

    public function updateRates()
    {
        $invoices = Invoice::where('exchange_rate', 0)->get();
        foreach ($invoices as $invoice) {
            $invoice_date = $invoice->date->format('Y-m-d');
            $rate = $this->findRate($invoice_date);

            $invoice->exchange_rate = $rate->value;
            $invoice->save();
        }
        dd($invoices);
    }

    private function findRate($invoice_date)
    {
        $date = new Carbon($invoice_date);

        if (Carbon::SATURDAY == $date->dayOfWeek || Carbon::SUNDAY == $date->dayOfWeek) {
            $date = $date->previousWeekday();
        }
        $value = DB::table('rates')->select('value')->where('date', $date)->first();
        if (is_null($value)) {
            $value['value'] = 0;
        }

        return $value;
    }
}