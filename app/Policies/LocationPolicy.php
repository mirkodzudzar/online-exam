<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    public function enable(User $user, Location $location)
    {
        // We are able to enable location only if it has been disabled.
        // dd(!$location->enabled);
        return !$location->enabled;
    }

    public function disable(User $user, Location $location)
    {
        // We are able to disabled location only if it has been enabled.
        return $location->enabled;
    }
}
