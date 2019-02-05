<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email',
    ];
    
     /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }
    
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
    
    /**
     * Record that the user has read the given post.
     *
     * @param Thread $post
     */
    public function read($post)
    {
        cache()->forever(
            $this->visitedPostCacheKey($post),
            Carbon::now()
        );
    }
    /**
     * Get the cache key for when a user reads a post.
     *
     * @param  Thread $post
     * @return string
     */
    public function visitedPostCacheKey($post)
    {
        return sprintf("users.%s.visits.%s", $this->id, $post->id);
    }
    
    /**
     * Get the path to the user's avatar.
     *
     * @param  string $avatar
     * @return string
     */
    public function getAvatarPathAttribute($avatar)
    {
        return asset($avatar ?: 'images/avatars/default.png');
    }
}
