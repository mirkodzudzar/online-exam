<?php

namespace App\Listeners;

use App\Models\CandidateQuestion;
use App\Events\CandidateProfessionUpdated;

class EvaluateStatusOfCandidateProfession
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CandidateProfessionUpdated $event)
    {
        $candidate_profession = $event->candidate_profession;
        $total = count($candidate_profession->profession->exam->questions);
        $attempted = [];
        $correct = [];
        $wrong = [];

        // First we are validating every question by specific name e.g answers15 and it is required.
        // There are many radio buttons with different name values depending on each question id.
        // Maybe there is some way better solution, but custom Request was not helpful right now,
        // because we need to loop through every question and give to it reqired attribute.
        foreach ($candidate_profession->profession->exam->questions as $question) {
            $rules["answers{$question->id}"] = 'required';
        }

        $validated = request()->validate($rules);
        
        // Once we have validated all data, we can proceed with data storing,
        // @TODO We still need to add functionality for exam to be filled only onec per candidate,
        // Each exam can belong to many Professions, so we can not save or override data many times for one question...
        foreach ($candidate_profession->profession->exam->questions as $question) {

            $answer = $validated["answers{$question->id}"];
            // Counting how many answers user provided.
            $attempted[] = $answer;
            // Is the answer correct?
            if ($answer === $question->answer_correct) {
                $correct[] = $answer;
            // Or is it wrong?
            } else {
                $wrong[] = $answer;
            }

            $candidate_questions[] = CandidateQuestion::create([
                'candidate_id' => $candidate_profession->candidate->id,
                'question_id' => $question->id,
                'candidate_answer' => $answer,
            ]);
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
