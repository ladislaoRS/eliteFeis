<?php

namespace App;

use App\Filters\PostFilters;
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
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
        
        static::deleting(function($post){
            $post->replies()->delete();
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
}
