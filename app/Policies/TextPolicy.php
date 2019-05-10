<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Text;
use Illuminate\Auth\Access\HandlesAuthorization;

class TextPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the text.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Text $text
     *
     * @return mixed
     */
    public function view(User $user, Text $text)
    {
        return true;
    }

    /**
     * Determine whether the user can create texts.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the text.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Text $text
     *
     * @return mixed
     */
    public function update(User $user, Text $text)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the text.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Text $text
     *
     * @return mixed
     */
    public function delete(User $user, Text $text)
    {
        return 0 === $text->poems()->count();
    }

    /**
     * Determine whether the user can restore the text.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Text $text
     *
     * @return mixed
     */
    public function restore(User $user, Text $text)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the text.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Text $text
     *
     * @return mixed
     */
    public function forceDelete(User $user, Text $text)
    {
        return false;
    }
}
