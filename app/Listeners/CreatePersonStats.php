<?php

namespace App\Listeners;

use App\Events\PatientCreated;
use App\PersonStats;

class CreatePersonStats
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PatientCreated $event)
    {
        $patient = $event->patient;
        $stats['patient_id'] = $patient->id;
        $stats['status'] = 0;
        $stats['amount_paid'] = 0;
        $stats['amount_due'] = 0;
        PersonStats::create($stats);
    }
}
