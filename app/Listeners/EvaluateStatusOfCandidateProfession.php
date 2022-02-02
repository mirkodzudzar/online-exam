<?php

namespace App\Listeners;

use App\Events\CandidateProfessionUpdate;

class EvaluateStatusOfCandidateProfession
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CandidateProfessionUpdate $event)
    {
        $candidate_profession = $event->candidate_profession;
        $total = count($candidate_profession->profession->exam->questions);
        $attempted = [];
        $correct = [];
        $wrong = [];

        foreach ($candidate_profession->profession->exam->questions as $question) {
            if (isset(request()->input("answers")[$question->id])) {
                $answer = request()->input("answers")[$question->id];
                // Counting how many answers user provided.
                $attempted[] = $answer;
                // Is the answer correct?
                if ($answer === $question->answer_correct) {
                    $correct[] = $answer;
                // Or is it wrong?
                } else {
                    $wrong[] = $answer;
                }
            }
        }

        $attempted = count($attempted);
        $correct = count($correct);
        $wrong = count($wrong);

        $candidate_profession->total = $total;
        $candidate_profession->attempted = $attempted;
        $candidate_profession->correct = $correct;
        $candidate_profession->wrong = $wrong;

        // Failed if we did not answered correctly at least half of the total number of questions.
        if ($total / 2 > $correct) {
            $candidate_profession->status = "failed";
        // Passed
        } else {
            $candidate_profession->status = "passed";
        }

        $candidate_profession->save();
    }
}
