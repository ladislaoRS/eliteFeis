<?php
namespace App;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;

class Trending
{
    /**
     * Fetch all trending posts.
     *
     * @return array
     */
    public function get($tag)
    {
        $posts = array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 3));

       if ($tag->exists) {
            $posts = array_filter($posts, function ($post) use($tag){
                return $post->tag_slug === $tag->slug;
            });
        }
        
        return $posts;
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
            'subtitle' => $post->subtitle,
            'created' => $post->created_at,
            'tag_slug' => $post->tag->slug,
            'comments' => $post->replies_count,
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