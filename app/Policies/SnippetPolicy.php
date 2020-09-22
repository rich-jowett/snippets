<?php

/**
 * SnippetPolicy.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class SnippetPolicy
 *
 * @author Rich Jowett <rich@jowett.me>
 * @package App\Policies
 */
class SnippetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Snippet  $snippet
     * @return mixed
     */
    public function view(User $user, Snippet $snippet)
    {
        return $snippet->created_by === $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Snippet  $snippet
     * @return mixed
     */
    public function update(User $user, Snippet $snippet)
    {
        return $snippet->created_by === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Snippet  $snippet
     * @return mixed
     */
    public function delete(User $user, Snippet $snippet)
    {
        return $snippet->created_by === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Snippet  $snippet
     * @return mixed
     */
    public function restore(User $user, Snippet $snippet)
    {
        return $snippet->created_by === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Snippet  $snippet
     * @return mixed
     */
    public function forceDelete(User $user, Snippet $snippet)
    {
        return $snippet->created_by === $user->id;
    }
}
