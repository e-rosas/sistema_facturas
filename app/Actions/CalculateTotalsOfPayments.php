<?php

namespace App\Actions;

class CalculateTotalsOfPayments
{
    public $amount_paid = 0;
    public $amount_paid_mxn = 0;
    private $payments = [];

    public function __construct($payments)
    {
        $this->addPayments($payments);
    }

    public function addPayments($payments)
    {
        $payments->map(function ($payment) {
            array_push($this->payments, $payment);
        });
    }

    /**
     * Get the value of amount_paid.
     */
    public function getAmount_paid()
    {
        return number_format($this->amount_paid, 4);
    }

    public function calculateTotals()
    {
        foreach ($this->payments as $payment) {
            $this->amount_paid += $payment->amount_paid;
            $this->amount_paid_mxn += $payment->amount_paid * $payment->exchange_rate;
        }
    }

    public function getPaymentsCount()
    {
        return count($this->payments);
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
