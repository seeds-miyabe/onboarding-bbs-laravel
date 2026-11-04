<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
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
    public function view($user, Comment $comment): bool
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
    public function update($user, Comment $comment): bool
    {
        return $user instanceof User && $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Comment $comment): bool
    {
        return $user instanceof User && $user->id === $comment->user_id;
    }
}
