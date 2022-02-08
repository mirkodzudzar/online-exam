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
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidateProfession  $candidateProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CandidateProfession $candidateProfession)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
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

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidateProfession  $candidateProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CandidateProfession $candidateProfession)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidateProfession  $candidateProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CandidateProfession $candidateProfession)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidateProfession  $candidateProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CandidateProfession $candidateProfession)
    {
        //
    }
}
