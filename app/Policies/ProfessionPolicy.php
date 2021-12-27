<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profession;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessionPolicy
{
    use HandlesAuthorization;

    // Check if user already applied for some profession
    public function apply(User $user, Profession $profession)
    {
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
        // If user is not candidate - admin
        if (is_null($user->candidate)) {
            return false;
        }
        // Check all candidate professions to be sure if we are able to unapply some profession
        $user_professions = $user->candidate->professions()->get();
        foreach ($user_professions as $user_profession) {
            if ($user_profession->id === $profession->id) {
                return true;
            }
        }

        return false;
    }
}
