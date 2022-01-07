<?php

namespace App\Providers;

use App\Http\ViewComposers\CountComposer;
use App\Models\Profession;
use App\Observers\ProfessionObserver;
use Illuminate\Support\ServiceProvider;

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
        view()->composer(['*'], CountComposer::class);
        
        // Registering new Observer for Profession model class
        Profession::observe(ProfessionObserver::class);
    }
}
