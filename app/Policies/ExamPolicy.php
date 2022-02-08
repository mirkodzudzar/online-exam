<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Exam $exam)
    {
        // If user is not candidate - admin
        if (is_null($user->candidate)) {
            return false;
        }

        // Go through each of candidate exams to see if cadidate already finished the exam.
        $candidate_exams = $user->candidate->exams;
        foreach ($candidate_exams as $candidate_exam) {
            if ($candidate_exam->id === $exam->id) {
                return false;
            }
        }

        // Another check is to confirm that status of candidate profession is 'applied'.
        $candidate_professions = $user->candidate->professions;
        foreach ($candidate_professions as $candidate_profession) {
            if ($candidate_profession->exam->id === $exam->id && $candidate_profession->pivot->status === 'applied') {
                return true;
            }
        }

        return false;
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
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Exam $exam)
    {
        //
    }
}
