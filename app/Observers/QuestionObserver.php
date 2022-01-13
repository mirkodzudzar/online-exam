<?php

namespace App\Observers;

use App\Models\Question;
use Illuminate\Support\Facades\Cache;

class QuestionObserver
{
    /**
     * Handle the Question "created" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function created(Question $question)
    {
        //
    }

    public function creating()
    {
        // Profession count will increase.
        Cache::forget('questions-count');
    }

    /**
     * Handle the Question "updated" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function updated(Question $question)
    {
        //
    }

    /**
     * Handle the Question "deleted" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function deleted(Question $question)
    {
        //
    }

    public function deleting()
    {
        // Destroyed questions count will increase.
        Cache::forget('questions-destoryed-count');
    }

    /**
     * Handle the Question "restored" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function restored(Question $question)
    {
        //
    }

    public function restoring()
    {
        // Destroyed questions count will decrease.
        Cache::forget('questions-destoryed-count');
    }

    /**
     * Handle the Question "force deleted" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function forceDeleted(Question $question)
    {
        // Question count will decrease.
        Cache::forget('questions-count');
        // Destroyed questions count will decrease.
        Cache::forget('questions-destoryed-count');
    }
}
