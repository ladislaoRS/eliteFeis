<?php
namespace App;
use Illuminate\Support\Facades\Redis;
class Trending
{
    /**
     * Fetch all trending posts.
     *
     * @return array
     */
    public function get()
    {
        return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 2));
    }
    /**
     * Push a new post to the trending list.
     *
     * @param Thread $post
     */
    public function push($post)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $post->title,
            'path' => $post->path(),
            'creator' => $post->creator->name,
            'tag_slug' => $post->tag->slug
        ]));
    }
    /**
     * Get the cache key name.
     *
     * @return string
     */
    public function cacheKey()
    {
        return app()->environment('testing')
            ? 'testing_trending_posts'
            : 'trending_posts';
    }
    /**
     * Reset all trending posts.
     */
    public function reset()
    {
        Redis::del($this->cacheKey());
    }
}