<?php

namespace App\Listeners;

use App\Events\CommentSenderDeleted;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearCommentsSender
{
    public function __construct()
    {
        //
    }

    public function handle(CommentSenderDeleted $event)
    {
        $entity = $event->entity;
        $type = get_class($entity);

        Comment::where('sender_type', $type)->where('sender_id', $entity->id)->update([
            'sender_id' => null,
//            'sender_type' => null
        ]);
    }
}
