<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($entity)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($entity, Comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($entity)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($entity, Comment $comment)
    {
        return $comment->sender_type === get_class($entity) && $comment->sender_id === $entity->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($entity, Comment $comment)
    {
        return $comment->sender_type === get_class($entity) && $comment->sender_id === $entity->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($entity, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($entity, Comment $comment)
    {
        //
    }
}
