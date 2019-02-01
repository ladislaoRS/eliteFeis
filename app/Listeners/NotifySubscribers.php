<?php

namespace App\Listeners;

use App\Events\PostReceivedNewReply;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostReceivedNewReply  $event
     * @return void
     */
    public function handle(PostReceivedNewReply $event)
    {
        $post = $event->reply->post;
        $post->subscriptions
            ->where('user_id', '!=', $event->reply->user_id)
            ->each
            ->notify($event->reply);
    }
}
