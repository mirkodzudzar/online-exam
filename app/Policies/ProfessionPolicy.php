<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profession;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Profession $profession)
    {
        // If we are not authenticated, we will be able to see all professions except expired ones.
        if (is_null($user)) {
            if ($profession->isExpired()) {
                return false;
            }
            return true;
        }
        // If user is not candidate - admin.
        if (is_null($user->candidate)) {
            return true;
        }
        // Check all candidate professions to be sure if we alredy applied,
        // we are able to visit all professions that we have applied for, even expired ones.
        $user_professions = $user->candidate->professions()->get();
        foreach ($user_professions as $user_profession) {
            if ($user_profession->id === $profession->id) {
                return true;
            }
        }

        // If profession is expired - close_date is older than current date/time
        if ($profession->isExpired()) {
            return false;
        }

        return true;
    }

    // Check if user already applied for some profession
    public function apply(User $user, Profession $profession)
    {
        // If profession is expired - close_date is older than current date/time
        if ($profession->isExpired()) {
            return false;
        }
        // If user is not candidate - admin
        if (is_null($user->candidate)) {
            return false;
        }
        // Check all candidate professions to be sure if we alredy applied
        $user_professions = $user->candidate->professions()->get();
        foreach ($user_professions as $user_profession) {
            if ($user_profession->id === $profession->id) {
                return false;
            }
        }

        return true;
    }

    // Check if user applied for some profession so it can be unapplied
    public function unapply(User $user, Profession $profession)
    {
        // If profession is expired - close_date is older than current date/time
        if ($profession->isExpired()) {
            return false;
        }
        // If user is not candidate - admin
        if (is_null($user->candidate)) {
            return false;
        }
        // Check all candidate professions to be sure if we are able to unapply some profession
        $user_professions = $user->candidate->professions()->get();
        foreach ($user_professions as $user_profession) {
            if ($user_profession->id === $profession->id) {
                // If status is passed or failed or unapplied, we can not do anything with this profession (only see the results).
                if ($user_profession->pivot->status !== 'applied') {
                    return false;
                }
                return true;
            }
        }

        return false;
    }
}
