<?php

namespace App\Observers;

use App\Models\Location;
use Illuminate\Support\Facades\Cache;

class LocationObserver
{
    /**
     * Handle the Location "created" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function created(Location $location)
    {
        //
    }

    public function creating(Location $location)
    {
        // Location count will increase.
        Cache::tags(['location'])->forget('count');
    }

    /**
     * Handle the Location "updated" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function updated(Location $location)
    {
        //
    }

    /**
     * Handle the Location "deleted" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function deleted(Location $location)
    {
        //
    }

    /**
     * Handle the Location "restored" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function restored(Location $location)
    {
        //
    }

    /**
     * Handle the Location "force deleted" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function forceDeleted(Location $location)
    {
        //
    }
}
