<?php

namespace App\Observers;

use App\Models\Profession;
use App\Models\CandidateProfession;
use Illuminate\Support\Facades\Cache;

class ProfessionObserver
{
    /**
     * Handle the Profession "created" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function created(Profession $profession)
    {
        //
    }

    public function creating()
    {
        // Profession coutn will increase.
        Cache::tags(['profession'])->forget('count');
    }

    /**
     * Handle the Profession "updated" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function updated(Profession $profession)
    {
        //
    }

    /**
     * Handle the Profession "deleted" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function deleted(Profession $profession)
    {
        //
    }

    public function deleting(Profession $profession)
    {
        $profession->questions()->delete();
        CandidateProfession::where('profession_id', $profession->id)->delete();
        // Destroyed profession count will increase.
        Cache::tags(['profession'])->forget('destoryed-count');
    }

    /**
     * Handle the Profession "restored" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function restored(Profession $profession)
    {
        //
    }

    public function restoring(Profession $profession)
    {
        $profession->questions()->restore();
        CandidateProfession::where('profession_id', $profession->id)->restore();
        // Destroyed profession count will decrease.
        Cache::tags(['profession'])->forget('destoryed-count');
    }

    /**
     * Handle the Profession "force deleted" event.
     *
     * @param  \App\Models\Profession  $profession
     * @return void
     */
    public function forceDeleted(Profession $profession)
    {
        $profession->questions()->forceDelete();
        $profession->candidates()->detach();
        // Profession count will decrease.
        Cache::tags(['profession'])->forget('count');
        // Expired profession count may decrease.
        Cache::tags(['profession'])->forget('expired-count');
        // Destroyed profession count will decrease.
        Cache::tags(['profession'])->forget('destoryed-count');
    }
}
