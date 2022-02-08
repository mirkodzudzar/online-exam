<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Location;
use App\Models\Question;
use App\Services\Counter;
use App\Models\Profession;
use App\Models\CandidateExam;
use App\Observers\UserObserver;
use App\Models\CandidateProfession;
use App\Observers\LocationObserver;
use App\Observers\QuestionObserver;
use Illuminate\Pagination\Paginator;
use App\Observers\ProfessionObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\CandidateExamObserver;
use App\Http\ViewComposers\CountComposer;
use App\Observers\CandidateProfessionObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // CountComposer variables will be available in all blatde tamplates
        view()->composer(['layouts.admin'], CountComposer::class);
        
        // Registering new Observer for Profession model class
        CandidateProfession::observe(CandidateProfessionObserver::class);
        Location::observe(LocationObserver::class);
        Profession::observe(ProfessionObserver::class);
        Question::observe(QuestionObserver::class);
        User::observe(UserObserver::class);
        CandidateExam::observe(CandidateExamObserver::class);

        // Include bootstrap for paginator styling.
        Paginator::useBootstrap();

        // // Registering service in services container.
        // Singleton means that if we call this service many times, it will create new instance only once.
        $this->app->singleton(Counter::class, function($app) {
            // If Counter is used, it will always be set here with 5 minutes timeout.
            // diffInMinutes is user inside Counter...
            return new Counter(
                // As same as resolve().
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('COUNTER_TIMEOUT')
            );
        });

        // If we call CounterContract interface, Counter class will be used insted.
        $this->app->bind(
            'App\Contracts\CounterContract',
            Counter::class,
        );

        // $this->app->when(Counter::class)
        //           ->needs('$timeout')
        //           ->give(env('COUNTER_TIMEOUT'));
    }
}
