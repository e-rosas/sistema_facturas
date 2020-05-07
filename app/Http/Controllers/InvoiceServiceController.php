<?php

namespace App\Http\Controllers;

use App\Events\InvoiceEvent;
use App\Invoice;
use App\InvoiceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceService $invoiceService)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceService $invoiceService)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceService $invoiceService)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceService $invoiceService)
    {
    }

    public function getInvoiceServices(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $services = InvoiceService::with('items')
            ->where('invoice_id', $invoice_id)->get();

        echo json_encode($services);
        exit;
    }

    public function updatePrices()
    {
        $invoices = Invoice::get();
        foreach ($invoices as $invoice) {
            if (0 == (float) str_replace(',', '', $invoice->exchange_rate)) {
                $invoice->exchange_rate = $this->getRate($invoice->date);
            }
            $invoice->sub_total_discounted = (float) str_replace(',', '', $invoice->sub_total);
            $invoice->total_with_discounts = (float) str_replace(',', '', $invoice->total);
            $invoice->amount_due = (float) str_replace(',', '', $invoice->total);
            $all_services = InvoiceService::where('invoice_id', $invoice->id)->get();
            foreach ($all_services as $service) {
                $service->discounted_price = (float) str_replace(',', '', $service->price);
                $service->sub_total_discounted = (float) str_replace(',', '', $service->sub_total);
                $service->total_discounted_price = (float) str_replace(',', '', $service->total_price);
                $service->save();
            }
            $invoice->save();
            event(new InvoiceEvent($invoice));
        }
    }

    private function getRate($date)
    {
        if (Carbon::SATURDAY == $date->dayOfWeek || Carbon::SUNDAY == $date->dayOfWeek) {
            $date = $date->previousWeekday();
        }
        $value = DB::table('rates')->select('value')->where('date', $date)->first();
        if (is_null($value)) {
            $value['value'] = 0;
        }

        return  $value->value;
    }
}
