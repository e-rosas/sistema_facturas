<?php

namespace App\Events;

use App\Patient;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PatientCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    public $patient;

    /**
     * Create a new event instance.
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /*
     * Get the channels the event should broadcast on.
     *
     * @return array|\Illuminate\Broadcasting\Channel
     */
    /* public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    } */
}
