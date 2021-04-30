<?php

namespace Motor\Revision\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Motor\Backend\Models\User;
use Motor\Revision\Models\Sponsor;

class SponsorPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param \Motor\Backend\Models\User $user
     * @param string $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('SuperAdmin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \Motor\Backend\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('sponsors.read');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Sponsor $sponsor
     * @return mixed
     */
    public function view(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('sponsors.read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \Motor\Backend\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('sponsors.write');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Sponsor $sponsor
     * @return mixed
     */
    public function update(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('sponsors.write');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Sponsor $sponsor
     * @return mixed
     */
    public function delete(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('sponsors.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Sponsor $sponsor
     * @return mixed
     */
    public function restore(User $user, Sponsor $sponsor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Sponsor $sponsor
     * @return mixed
     */
    public function forceDelete(User $user, Sponsor $sponsor)
    {
        //
    }
}
