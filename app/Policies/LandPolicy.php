<?php

namespace App\Policies;

use App\Models\Land;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LandPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Land $land): bool
    {
        return $user->id === $land->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (auth()->user()->isAdmin()) {
            return true;
        } else {
            return auth()->user()->uploads > 0;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Land $land): bool
    {
        return $user->id === $land->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Land $land): bool
    {
        return $user->id === $land->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Land $land): bool
    {
        return $user->id === $land->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Land $land): bool
    {
        return $user->id === $land->user_id || $user->isAdmin();
    }
}
