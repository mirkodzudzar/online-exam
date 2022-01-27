<?php

namespace App\Jobs;

use App\Mail\ProfessionFinishedForAdmins;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\CandidateProfession;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyAdminsProfessionFinishedWithResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $candidate_profession;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CandidateProfession $candidate_profession)
    {
        $this->candidate_profession = $candidate_profession;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::onlyAdminUsers()
            ->get()
            ->map(function (User $user) {
                ThrottledMail::dispatch(
                    new ProfessionFinishedForAdmins($this->candidate_profession, $user),
                    $user,
                );
            });
    }
}
