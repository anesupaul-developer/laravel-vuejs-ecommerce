<?php

namespace App\Policies;

use App\Definitions\UserType;
use App\Models\StoreAccount;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StoreAccountPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(UserType::getAdminRolesOnly());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StoreAccount $customer): bool
    {
        return $user->hasRole(UserType::getAdminRolesOnly());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(UserType::getAdminRolesOnly());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StoreAccount $customer): bool
    {
        return $user->hasRole(UserType::getAdminRolesOnly());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StoreAccount $customer): bool
    {
        return $user->hasRole(UserType::getAdminRolesOnly());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StoreAccount $customer): bool
    {
        return $user->hasRole(UserType::getAdminRolesOnly());
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StoreAccount $customer): bool
    {
        return $user->hasRole(UserType::getAdminRolesOnly());
    }
}
