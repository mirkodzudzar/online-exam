<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CandidateProfession;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidateProfessionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, CandidateProfession $candidateProfession)
    {
        if (is_null($user->candidate)) {
            return false;
        }

        return $user->candidate->id === $candidateProfession->candidate->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidateProfession  $candidateProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CandidateProfession $candidateProfession)
    {
        // If there are no question.
        if ($candidateProfession->profession->exam->questions->count() === 0) {
            return false;
        }
        // Only if status is applied, we can proceed with the profession questions.
        if ($candidateProfession->status !== 'applied') {
            return false;
        }
        // If profession is expired - close_date is older than current date/time,
        // or if status is just applied then we can not update candidate_profession table record.
        if ($candidateProfession->profession->isExpired() &&
            $candidateProfession->status === 'applied') {
            return false;
        }

        return true;
    }

    public function results(User $user, CandidateProfession $candidateProfession)
    {
        // If user is not candidate - admin
        if (is_null($user->candidate)) {
            return false;
        }

        return true;
    }
}
