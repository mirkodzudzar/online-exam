<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\CandidateProfession;
use Illuminate\Queue\SerializesModels;

class ProfessionFinishedForAdmins extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate_profession;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CandidateProfession $candidate_profession, User $user)
    {
        $this->candidate_profession = $candidate_profession;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Candidate {$this->candidate_profession->candidate->username} has finished the exam for profession '{$this->candidate_profession->profession->title}'.";
        
        return $this->subject($subject)
                    ->markdown('emails.professions.finished-for-admins');
    }
}
