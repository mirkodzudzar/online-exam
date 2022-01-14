<?php

namespace App\Listeners;

use App\Jobs\ThrottledMail;
use App\Events\ProfessionFinished;
use App\Mail\ProfessionFinishedWithResult;
use App\Jobs\NotifyAdminsProfessionFinishedWithResult;

class NotifyUsersProfessionFinished
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
    public function handle(ProfessionFinished $event)
    {
        // This needs to be moved outside of controller later.
        // Mail will be sent to a user that has finished the profession questions.
        ThrottledMail::dispatch(
            new ProfessionFinishedWithResult($event->candidate_profession), 
            $event->candidate_profession->candidate->user
        );

        // Custom job that sends emails to all the admin users.
        NotifyAdminsProfessionFinishedWithResult::dispatch($event->candidate_profession);
    }
}
