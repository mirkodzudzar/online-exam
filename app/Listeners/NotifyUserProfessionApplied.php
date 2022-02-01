<?php

namespace App\Listeners;

use App\Jobs\ThrottledMail;
use App\Mail\ProfessionApplied;
use App\Events\ProfessionApplied as ProfessionAppliedEvent;

class NotifyUserProfessionApplied
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProfessionAppliedEvent $event)
    {
        // Mail will be sent to a user that has applied for this profession.
        ThrottledMail::dispatch(
            new ProfessionApplied($event->candidate, $event->profession), 
            $event->candidate->user
        );
    }
}
