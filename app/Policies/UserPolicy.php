<?php

namespace App\Policies;

use App\Models\Users;
use Illuminate\Auth\Access\Response;
use Modules\User\src\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $roleJson = $user->groups->permissions;

        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
        }

        $check = isRole($roleArr, 'users');

        return $check;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Users $users): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $roleJson = $user->groups->permissions;

        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
        }

        $check = isRole($roleArr, 'users','add');

        return $check;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Users $users): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Users $users): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Users $users): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Users $users): bool
    {
        //
    }
}
