<?php

namespace App\Listeners;

use App\Actions\CalculatePersonStats;
use App\PersonStats;

class UpdatePersonStats
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function invoice($event)
    {
        $patient_id = $event->invoice->patient_id;
        $this->updateStats($patient_id);
    }

    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function payment($event)
    {
        $patient_id = $event->payment->invoice->patient_id;
        $this->updateStats($patient_id);
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\InvoiceEvent',
            'App\Listeners\UpdatePersonStats@invoice'
        );

        $events->listen(
            'App\Events\PaymentEvent',
            'App\Listeners\UpdatePersonStats@payment'
        );
    }

    private function updateStats($id)
    {
        $stats = new CalculatePersonStats();
        $stats->calculateAmounts($id);
        $person_stats = PersonStats::where('patient_id', $id)->first();

        $person_stats->total_amount_due = $stats->amount_due_without_discounts;
        $person_stats->amount_due = $stats->amount_due;

        $person_stats->amount_paid = $stats->getAmountPaid();
        $person_stats->save();
    }
}
