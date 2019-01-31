<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Filters\PostFilters;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @param  Tag      $Tag
     * @param ThreadFilters $filters
     * @param \App\Trending $trending
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag, PostFilters $filters)
    {
        $posts = $this->getPosts($tag, $filters);

        return view('posts.index', [
            'posts' => $posts,
            // 'tag' => $tag
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tag_id' => 'required|exists:tags,id'
        ]);
        
        $post = Post::create([
            'user_id' => auth()->id(),
            'tag_id' => $request->input('tag_id'),
            'title' => $request->input('title'),
            'body'  => $request->input('body')
        ]);
        return redirect($post->path())->with('flash', 'Your post have been published');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function show($tagId, Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update([
            'body' => $request->input('body')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag, Post $post)
    {
        $post->delete();
        
        if (request()->wantsJson()) {
            return response([], 204);
        }
        
        return redirect('/posts');
    }
    
    /**
     * Fetch all relevant threads.
     *
     * @param Channel       $tag
     * @param ThreadFilters $filters
     * @return mixed
     */
    protected function getPosts(Tag $tag, PostFilters $filters)
    {
        $posts = Post::latest()->filter($filters);

        if ($tag->exists) {
            $posts->where('tag_id', $tag->id);
        }

        return $posts->paginate(5);
    }
}
