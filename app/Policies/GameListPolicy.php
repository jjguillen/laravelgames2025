<?php

namespace App\Policies;

use App\Models\GameList;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GameListPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GameList $gameList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GameList $gameList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GameList $gameList): bool
    {
        if ($gameList->user_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GameList $gameList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GameList $gameList): bool
    {
        return false;
    }

    public function addGame(User $user, GameList $gameList): bool
    {
        if ($gameList->user_id == $user->id) {
            return true;
        }

        return false;
    }

    public function deleteGame(User $user, GameList $gameList): bool
    {
        if ($gameList->user_id == $user->id) {
            return true;
        }

        return false;
    }
}
