<?php

namespace App\Actions;

use App\Invoice;
use App\Payment;

class CalculatePersonStats
{
    public $total_invoices;
    public $total_payments;
    public $amount_due = 0;
    public $amount_due_without_discounts = 0;

    public function getAllInvoices($person_data_id)
    {
        $allInvoices = Invoice::where('person_data_id', '=', $person_data_id)->get();
        $total_invoices = new CalculateTotalsOfInvoices($allInvoices);
        $total_invoices->calculateTotals();

        return $total_invoices;
    }

    public function getAllPayments($person_data_id)
    {
        $allPayments = Payment::where('person_data_id', '=', $person_data_id)->get();
        $total_payments = new CalculateTotalsOfPayments($allPayments);
        $total_payments->calculateTotals();

        return $total_payments;
    }

    public function calculateAmounts($person_data_id)
    {
        $this->total_invoices = $this->getAllInvoices($person_data_id);
        $this->total_payments = $this->getAllPayments($person_data_id);
        $this->amount_due =
            $this->total_invoices->total_with_discounts - $this->total_payments->amount_paid;

        $this->amount_due_without_discounts =
            $this->total_invoices->total;
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
        return $this->total_payments->amount_paid;
    }
}
