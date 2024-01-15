<?php

namespace App\Policies;

use App\Models\Fashion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FashionPolicy
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
    public function view(User $user, Fashion $fashion): bool
    {
        return $user->id === $fashion->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (auth()->user()->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fashion $fashion): bool
    {
        return $user->id === $fashion->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fashion $fashion): bool
    {
        return $user->id === $fashion->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Fashion $fashion): bool
    {
        return $user->id === $fashion->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Fashion $fashion): bool
    {
        return $user->id === $fashion->user_id || $user->isAdmin();
    }
}
