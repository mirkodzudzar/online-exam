<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profession;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessionPolicy
{
    use HandlesAuthorization;

    public function apply(User $user, Profession $profession)
    {
        if (is_null($user->candidate)) {
            return false;
        }

        $user_professions = $user->candidate->professions()->get();
        foreach ($user_professions as $user_profession) {
            if ($user_profession->id === $profession->id) {
                return false;
            }
        }

        return true;
    }

    public function unapply(User $user, Profession $profession)
    {
        if (is_null($user->candidate)) {
            return false;
        }

        $user_professions = $user->candidate->professions()->get();
        foreach ($user_professions as $user_profession) {
            if ($user_profession->id === $profession->id) {
                return true;
            }
        }

        return false;
    }
}
