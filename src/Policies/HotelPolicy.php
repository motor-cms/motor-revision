<?php

namespace Motor\Revision\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Motor\Backend\Models\User;
use Motor\Revision\Models\Hotel;

class HotelPolicy
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
        return $user->hasPermissionTo('hotels.read');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Hotel $hotel
     * @return mixed
     */
    public function view(User $user, Hotel $hotel)
    {
        return $user->hasPermissionTo('hotels.read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \Motor\Backend\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('hotels.write');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Hotel $hotel
     * @return mixed
     */
    public function update(User $user, Hotel $hotel)
    {
        return $user->hasPermissionTo('hotels.write');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Hotel $hotel
     * @return mixed
     */
    public function delete(User $user, Hotel $hotel)
    {
        return $user->hasPermissionTo('hotels.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Hotel $hotel
     * @return mixed
     */
    public function restore(User $user, Hotel $hotel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \Motor\Backend\Models\User $user
     * @param \Motor\Revision\Models\Hotel $hotel
     * @return mixed
     */
    public function forceDelete(User $user, Hotel $hotel)
    {
        //
    }
}
