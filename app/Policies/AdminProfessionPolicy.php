<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminProfessionPolicy
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
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Profession $profession)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Profession $profession)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Profession $profession)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Profession $profession)
    {
        return $user->is_admin;
    }

    public function restoreAll(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Profession $profession)
    {
        return $user->is_admin;
    }

    public function destroyed(User $user)
    {
        return $user->is_admin;
    }

    public function expired(User $user)
    {
        return $user->is_admin;
    }
}
