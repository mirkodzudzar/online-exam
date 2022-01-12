<?php

namespace App\Providers;

use App\Models\Profession;
use Illuminate\Pagination\Paginator;
use App\Observers\ProfessionObserver;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CountComposer;

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
        Profession::observe(ProfessionObserver::class);

        // Include bootstrap for paginator styling.
        Paginator::useBootstrap();
    }
}
