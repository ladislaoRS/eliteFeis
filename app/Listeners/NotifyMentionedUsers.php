<?php

namespace App\Listeners;

use App\User;
use App\Events\PostReceivedNewReply;
use App\Notifications\YouWereMentioned;

class NotifyMentionedUsers
{
   /**
     * Handle the event.
     *
     * @param  ThreadReceivedNewReply $event
     * @return void
     */
    public function handle(PostReceivedNewReply $event)
    {
        User::whereIn('name', $event->reply->mentionedUsers())
            ->get()
            ->each(function ($user) use ($event) {
                $user->notify(new YouWereMentioned($event->reply));
            });
    }
}
