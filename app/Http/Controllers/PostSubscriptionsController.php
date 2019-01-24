<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostSubscription;
use Illuminate\Http\Request;

class PostSubscriptionsController extends Controller
{
   
     /**
     * Store a new post subscription.
     *
     * @param int    $tagId
     * @param Post $post
     */
    public function store($tagId, Post $post)
    {
        $post->subscribe();
    }
    /**
     * Delete an existing post subscription.
     *
     * @param int    $tagId
     * @param Post $post
     */
    public function destroy($tagId, Post $post)
    {
        $post->unsubscribe();
    }
}
