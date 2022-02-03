<?php

namespace App\Observers;

use App\Models\CandidateProfession;

class CandidateProfessionObserver
{

    public function updating(CandidateProfession $candidate_profession)
    {
        // Check value not to have division by zero.
        if ($candidate_profession->correct > 0 && $candidate_profession->total > 0) {
            $percentage = ($candidate_profession->correct / $candidate_profession->total) * 100;
            $percentage = number_format($percentage, 2, '.', '');  // two decimal places, outputs e.g. 33.33
            $candidate_profession->percentage = $percentage;
        }
    }
}
