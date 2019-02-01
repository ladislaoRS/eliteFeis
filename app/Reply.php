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
    
     /**
     * Fetch all mentioned users within the reply's body.
     *
     * @return array
     */
    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+[\w ]+)/', $this->body, $matches);
        $matches[1];
    }
    
     /**
     * Set the body attribute.
     *
     * @param string $body
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-]+[\w ]+)/',
            '<a href="/profiles/$1">$0</a>',
            $body
        );
    }
    
}
