<?php

namespace App\Observers;

use App\Models\CandidateProfession;

class CandidateProfessionObserver
{

    public function updating(CandidateProfession $candidate_profession)
    {
        $percentage = round(($candidate_profession->correct / $candidate_profession->total) * 100, 2);
        $candidate_profession->percentage = $percentage;
    }
}
