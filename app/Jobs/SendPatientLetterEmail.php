<?php

namespace App\Jobs;

use App\Mail\PatientLetter;
use App\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPatientLetterEmail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    public $patient;
    public $letter_path;
    public $to;

    /**
     * Create a new job instance.
     *
     * @param mixed $letter_path
     * @param mixed $to
     */
    public function __construct(Patient $patient, $letter_path, $to)
    {
        $this->patient = $patient;
        $this->letter_path = $letter_path;
        $this->to = $to;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $email = new PatientLetter($this->patient, $this->letter_path);
        Mail::to($this->to)->send($email);
    }
}