<?php

namespace App\Policies;

use App\Models\CandidateExam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidateExamPolicy
{
    use HandlesAuthorization;

    public function results(User $user, CandidateExam $candidate_exam)
    {
        // If user is not candidate - admin
        if (is_null($user->candidate)) {
            return false;
        }

        // Returns true only if exam result belongs to current user candidate.
        return $user->candidate->id === $candidate_exam->candidate->id;
    }
}
