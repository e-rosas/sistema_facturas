<?php

namespace App\Mail;

use App\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientLetter extends Mailable
{
    use Queueable;
    use SerializesModels;
    public $patient;
    public $letter_path;

    /**
     * Create a new message instance.
     *
     * @param mixed $letter_path
     */
    public function __construct(Patient $patient, $letter_path)
    {
        $this->patient = $patient;
        $this->letter_path = $letter_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.letters.patient')
            ->subject('subject Here')
            ->attach($this->letter_path, [
                'as' => 'letter.pdf',
                'mime' => 'application/pdf',
            ])
        ;
    }
}