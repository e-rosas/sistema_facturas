<?php

namespace App\Actions;

class CalculateTotalsOfInvoices
{
    public $total = 0;
    public $total_with_discounts = 0;
    public $subtotal = 0;
    public $subtotal_with_discounts = 0;
    public $dtax = 0;
    public $amount_due = 0;
    public $amount_paid = 0;
    public $amount_due_m = 0;
    public $amount_credit = 0;
    public $amount_credit_m = 0;
    public $amount_paid_m = 0;
    public $subtotal_m = 0;
    public $IVA = 0;
    public $total_m = 0;
    public $percentage_paid = 0;
    public $percentage_due = 0;
    public $percentage_credit = 0;
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

    public function getAmountCredit()
    {
        return number_format($this->amount_credit, 4);
    }

    public function calculateTotals()
    {
        foreach ($this->invoices as $invoice) {
            $allPayments = $invoice->payments;
            $total_payments = new CalculateTotalsOfPayments($allPayments);
            $total_payments->calculateTotals();

            if (is_null(($invoice->credit))) {
                $credit = 0;
            } else {
                $credit = $invoice->credit->amount_due;
            }

            $invoice->amount_paid = $total_payments->amount_paid;
            $invoice->amount_credit = $credit;
            $invoice->amount_due = $invoice->total_with_discounts - $invoice->amount_paid - $credit;
            /* if($invoice->amount_paid == 0){
                $invoice->type = 2;
            } */
            $invoice->save();

            $this->sumInvoiceStats($invoice);
        }
    }

    public function totals() //stats on report index (medTable)
    {
        foreach ($this->invoices as $invoice) {
            $this->sumInvoiceStats($invoice);
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

    public function amountPaidMXN()
    {
        return number_format($this->amount_paid_m, 4);
    }

    public function amountCreditMXN()
    {
        return number_format($this->amount_credit_m, 4);
    }

    public function amountDueMXN()
    {
        return number_format($this->amount_due_m, 4);
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

    public function percentagePaid()
    {
        $this->percentage_paid = ($this->amount_paid / $this->total_with_discounts) * 100;

        return number_format($this->percentage_paid, 2);
    }

    public function percentageCredit()
    {
        $this->percentage_credit = ($this->amount_credit / $this->total_with_discounts) * 100;

        return number_format($this->percentage_credit, 2);
    }

    public function percentageDue()
    {
        $this->percentage_due = ($this->amount_due / $this->total_with_discounts) * 100;

        return number_format($this->percentage_due, 2);
    }

    private function sumInvoiceStats($invoice)
    {
        $this->total += $invoice->total;
        $this->total_with_discounts += $invoice->total_with_discounts;
        $this->subtotal_with_discounts += $invoice->sub_total_discounted;
        $this->amount_paid += $invoice->amount_paid;
        $this->amount_paid_m += $invoice->pago();
        $this->amount_credit += $invoice->amount_credit;
        $this->amount_credit_m += $invoice->amount_credit_mxn;

        $this->dtax += $invoice->dtax;

        $this->amount_due += $invoice->amount_due;
        $this->amount_due_m += $invoice->debe();

        /* if (is_null($invoice->credit)) {
            $this->amount_due += $invoice->amount_due;
            $this->amount_due_m += $invoice->debe();
        } else {
            $this->amount_due += $invoice->credit->amount_due;
            $this->amount_due_m += $invoice->credit->debe();
        } */

        $this->subtotal_m += $invoice->subtotal();
        $this->IVA += $invoice->IVA();
        $this->total_m += $invoice->total();
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