<?php

namespace App\Http\Controllers;

use App\Post;
use App\Trending;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * undocumented class variable
     *
     * @var string
     */
    public function show(Trending $trending)
    {
        $search = request('q');
        
        $posts = Post::search($search)->paginate(25);
        
        if(request()->expectsJson()){
            return $posts;   
        }
        
        return view('posts.index', [
            'posts' => $posts,
            'trending' => $trending->get()
        ]);
    }
}
