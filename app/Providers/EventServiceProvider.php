<?php

namespace App\Providers;

use App\Events\CandidateProfessionUpdate;
use App\Events\ProfessionApplied;
use App\Events\ProfessionFinished;
use App\Listeners\EvaluateStatusOfCandidateProfession;
use App\Listeners\NotifyUserProfessionApplied;
use Illuminate\Auth\Events\Registered;
use App\Listeners\NotifyUsersProfessionFinished;
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
        
        ProfessionFinished::class => [
            NotifyUsersProfessionFinished::class,
        ],

        ProfessionApplied::class => [
            NotifyUserProfessionApplied::class,
        ],

        CandidateProfessionUpdate::class => [
            EvaluateStatusOfCandidateProfession::class,
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
