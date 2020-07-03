<?php

namespace App\Actions;

use App\Invoice;

class CalculatePersonStats
{
    public $total_invoices;
    public $amount_due = 0;
    public $amount_due_without_discounts = 0;
    public $amount_due__mxn = 0;
    public $amount_paid_mxn = 0;

    public function getAllInvoices($patient_id)
    {
        $allInvoices = Invoice::with('payments', 'charge', 'credit')->where('patient_id', $patient_id)->get();

        $total_invoices = new CalculateTotalsOfInvoices($allInvoices);
        $total_invoices->calculateTotals();

        return $total_invoices;
    }

    public function calculateAmounts($patient_id)
    {
        $this->total_invoices = $this->getAllInvoices($patient_id);
        $this->amount_due =
            $this->total_invoices->amount_due;

        $this->amount_due_mxn =
            $this->total_invoices->amount_due_m;

        $this->amount_paid_mxn =
            $this->total_invoices->amount_paid_m;

        /* $this->amount_due_without_discounts =
            $this->total_invoices->total - $this->total_invoices->amount_due; */
    }

    /**
     * Get the value of amount_due.
     */
    public function getAmount_due()
    {
        return number_format($this->amount_due, 3);
    }

    /**
     * Get the value of amount_due.
     */
    public function getAmount_due_without_discounts()
    {
        return number_format($this->amount_due_without_discounts, 3);
    }

    /**
     * Get the value of amount_due.
     */
    public function getAmountPaid()
    {
        return $this->total_invoices->amount_paid;
    }
}