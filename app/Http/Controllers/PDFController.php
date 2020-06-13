<?php

namespace App\Http\Controllers;

use App\Actions\PrepareInvoicePDF;
use App\Invoice;

class PDFController extends Controller
{
    public function hospitalization()
    {
        $invoice = Invoice::find(75);
        $pdf = new PrepareInvoicePDF($invoice);
        $categories = $pdf->serviceCategories();
        var_dump($categories);
    }
}
