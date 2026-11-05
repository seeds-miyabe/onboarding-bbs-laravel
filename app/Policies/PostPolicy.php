<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    public function before($user, string $ability): ?bool
    {
        if ($user instanceof Admin) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Post $post): bool
    {
        return $user instanceof User && $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Post $post): bool
    {
        return $user instanceof User && $user->id === $post->user_id;
    }
}
