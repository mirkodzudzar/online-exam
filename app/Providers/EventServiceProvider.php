<?php

namespace App\Providers;

use App\Events\CandidateHasRegistered;
use App\Events\ProfessionApplied;
use Illuminate\Auth\Events\Registered;
use App\Events\CandidateProfessionUpdated;
use App\Listeners\NotifyUserProfessionApplied;
use App\Listeners\NotifyUsersProfessionFinished;
use App\Listeners\EvaluateStatusOfCandidateProfession;
use App\Listeners\NotifyCandidateAboutRegistration;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ProfessionApplied::class => [
            NotifyUserProfessionApplied::class,
        ],

        CandidateProfessionUpdated::class => [
            EvaluateStatusOfCandidateProfession::class,
            NotifyUsersProfessionFinished::class,
        ],

        CandidateHasRegistered::class => [
            NotifyCandidateAboutRegistration::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
