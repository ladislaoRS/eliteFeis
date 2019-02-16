<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Trending;
use App\Rules\Recaptcha;
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
    public function index(Tag $tag, PostFilters $filters, Trending $trending)
    {
        $posts = $this->getPosts($tag, $filters);

        return view('posts.index', [
            'posts' => $posts,
            'trending' => $trending->get()
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
    public function store(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'body' => 'required',
            'tag_id' => 'required|exists:tags,id',
            'g-recaptcha-response' => ['required', $recaptcha]
        ]);
        
        $post = Post::create([
            'user_id' => auth()->id(),
            'tag_id' => $request->input('tag_id'),
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'body'  => $request->input('body')
        ]);
        
        if (request()->wantsJson()) {
            return response($post, 201);
        }
        
        return redirect($post->path())->with('flash', 'Your post have been published');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function show($tagId, Post $post, Trending $trending)
    {
        if (auth()->check()) {
            auth()->user()->read($post);
        }
        
        $trending->push($post);
        $post->increment('visits');
        
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
    public function update(Request $request, $tagId, Post $post)
    {
        $this->authorize('update', $post);
        $post->update([
            'body' => $request->input('body')
        ]);
        
        return $post;
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
     * Fetch all relevant posts.
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
