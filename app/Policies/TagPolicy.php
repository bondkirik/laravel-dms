<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tags.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('read tags')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the tag.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Tag $tag
     * @return mixed
     */
    public function view(User $user, Tag $tag)
    {
        if ($user->can('read tags')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create tags.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create tags')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the tag.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Tag $tag
     * @return mixed
     */
    public function update(User $user, Tag $tag)
    {
        if ($user->can('update tags')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the tag.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Tag $tag
     * @return mixed
     */
    public function delete(User $user, Tag $tag)
    {
        if ($user->can('delete tags')) {
            return true;
        } else {
            return false;
        }
    }

}
