<?php

namespace App\Observers;

use App\Models\Question;
use App\Models\Profession;
use App\Models\CandidateProfession;

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
    }
}
