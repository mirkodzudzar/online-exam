<?php

namespace App\Mail;

use App\Models\Candidate;
use App\Models\Profession;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfessionApplied extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $profession;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate, Profession $profession)
    {
        $this->profession = $profession;
        $this->candidate = $candidate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "You have applied for '{$this->profession->title}' profession.";

        return $this->subject($subject)
                    ->view('emails.professions.applied');
    }
}
