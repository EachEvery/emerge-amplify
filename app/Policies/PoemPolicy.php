<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Poem;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the poem.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Poem $poem
     *
     * @return mixed
     */
    public function view(User $user, Poem $poem)
    {
        return true;
    }

    /**
     * Determine whether the user can create poems.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the poem.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Poem $poem
     *
     * @return mixed
     */
    public function update(User $user, Poem $poem)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the poem.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Poem $poem
     *
     * @return mixed
     */
    public function delete(User $user, Poem $poem)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the poem.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Poem $poem
     *
     * @return mixed
     */
    public function restore(User $user, Poem $poem)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can permanently delete the poem.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Poem $poem
     *
     * @return mixed
     */
    public function forceDelete(User $user, Poem $poem)
    {
        return $user->isDeveloper();
    }
}
