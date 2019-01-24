<?php

namespace App;

use App\Filters\PostFilters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     use RecordsActivity;
     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    protected $with = ['creator', 'tag'];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['isSubscribedTo'];
    
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
        
        static::deleting(function($post){
            $post->replies->each->delete();
        });
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
    
    public function path()
    {
         return "/posts/{$this->tag->slug}/{$this->id}";
    }
    
    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, PostFilters $filters)
    {
        return $filters->apply($query);
    }
    
    /**
     * Subscribe a user to the current thread.
     *
     * @param int|null $userId
     */
    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: Auth::user()->id
        ]);
    }
    /**
     * Unsubscribe a user from the current thread.
     *
     * @param int|null $userId
     */
    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?:Auth::user()->id)
            ->delete();
    }
    /**
     * A thread can have many subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(PostSubscription::class);
    }
    /**
     * Determine if the current user is subscribed to the thread.
     *
     * @return boolean
     */
    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', Auth::user()->id)
            ->exists();
    }
}
