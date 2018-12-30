<?php

namespace App;

use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;
    
    protected $with = ['owner', 'favorites'];
    
    protected $guarded = [];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['favoritesCount', 'isFavorited'];
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function path()
    {
        return $this->post->path() . "#reply-{$this->id}";
    }
    
}
