<?php

namespace App\Actions;

use App\Payment;

class CalculateTotalsOfInvoices
{
    public $total = 0;
    public $total_with_discounts = 0;
    public $subtotal = 0;
    public $subtotal_with_discounts = 0;
    public $dtax = 0;
    public $amount_due = 0;
    public $amount_paid = 0;
    public $subtotal_m = 0;
    public $IVA = 0;
    public $total_m = 0;
    private $invoices = [];

    public function __construct($invoices)
    {
        $this->addInvoices($invoices);
    }

    public function addInvoices($invoices)
    {
        $invoices->map(function ($invoice) {
            array_push($this->invoices, $invoice);
        });
    }

    /**
     * Get the value of total.
     */
    public function getTotal()
    {
        return number_format($this->total, 4);
    }

    public function getSubtotal()
    {
        return number_format($this->subtotal_with_discounts, 4);
    }

    public function getDTax()
    {
        return number_format($this->dtax, 4);
    }

    /**
     * Get the value of total_with_discounts.
     */
    public function getTotal_with_discounts()
    {
        return number_format($this->total_with_discounts, 4);
    }

    /**
     * Get the value of amount_due.
     */
    public function getAmountDue()
    {
        return number_format($this->amount_due, 4);
    }

    public function getAmountPaid()
    {
        return number_format($this->amount_paid, 4);
    }

    public function calculateTotals()
    {
        foreach ($this->invoices as $invoice) {
            $allPayments = Payment::where('invoice_id', $invoice->id)->get();
            $total_payments = new CalculateTotalsOfPayments($allPayments);
            $total_payments->calculateTotals();

            $invoice->amount_paid = $total_payments->amount_paid;
            $invoice->amount_due = $invoice->total_with_discounts - $total_payments->amount_paid;
            $invoice->save();

            $this->amount_paid += $total_payments->amount_paid;
            $this->total += $invoice->total;
            $this->total_with_discounts += $invoice->total_with_discounts;
            $this->amount_due += $invoice->amount_due;
        }
    }

    public function totals() //stats on report index (medTable)
    {
        foreach ($this->invoices as $invoice) {
            $this->total_with_discounts += $invoice->total_with_discounts;
            $this->subtotal_with_discounts += $invoice->sub_total_discounted;
            $this->amount_paid += $invoice->amount_paid;
            $this->dtax += $invoice->dtax;
            if (is_null($invoice->credit)) {
                $this->amount_due += $invoice->amount_due;
            } else {
                $this->amount_paid += $invoice->credit->amount_due;
            }

            $this->subtotal_m += $invoice->subtotal();
            $this->IVA += $invoice->IVA();
            $this->total_m += $invoice->total();
        }
    }

    public function totalsShort() //stats on report index (shortTable)
    {
        foreach ($this->invoices as $invoice) {
            $this->subtotal_m += $invoice->subtotal();
            $this->IVA += $invoice->IVA();
            $this->total_m += $invoice->total();
        }
    }

    public function getSubtotalM()
    {
        return number_format($this->subtotal_m, 4);
    }

    public function getIVA()
    {
        return number_format($this->IVA, 4);
    }

    public function getTotalM()
    {
        return number_format($this->total_m, 4);
    }

    public function getInvoicesCount()
    {
        return count($this->invoices);
    }

    // Shortens a number and attaches K, M, B, etc. accordingly
    /* private function number_shorten($number, $precision = 3, $divisors = null)
    {
        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = [
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            ];
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return 0 + number_format($number / $divisor, $precision).$shorthand;
    } */
}
