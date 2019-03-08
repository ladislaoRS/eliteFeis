<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('postsCount', function ($builder) {
            $builder->withCount('posts');
        });
    }
    
     /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
