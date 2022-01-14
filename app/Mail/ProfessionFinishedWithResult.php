<?php

namespace App\Mail;

use App\Models\CandidateProfession;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfessionFinishedWithResult extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate_profession;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CandidateProfession $candidate_profession)
    {
        $this->candidate_profession = $candidate_profession;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "You have finish the exam for profession '{$this->candidate_profession->profession->title}'.";

        return $this->subject($subject)
                    ->markdown('emails.professions.finished-with-result');
    }
}
