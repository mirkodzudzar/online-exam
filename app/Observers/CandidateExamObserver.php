<?php

namespace App\Observers;

use App\Models\CandidateExam;

class CandidateExamObserver
{
    public function creating(CandidateExam $candidate_exam)
    {
        // Check value not to have division by zero.
        if ($candidate_exam->correct > 0 && $candidate_exam->total > 0) {
            $percentage = ($candidate_exam->correct / $candidate_exam->total) * 100;
            $percentage = number_format($percentage, 2, '.', '');  // two decimal places, outputs e.g. 33.33
            $candidate_exam->percentage = $percentage;
        }
    }
}
