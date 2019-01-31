<?php

namespace App\Http\Controllers;

use App\Post;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    protected $guarded = [];
    
    public function __construct()
    {
         $this->middleware('auth', ['except' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tagId, Post $post)
    {
        return $post->replies()->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($tagId, Request $request, Post $post)
    {
         $request->validate([
             'body' => 'required'
        ]);

        $reply = $post->addReply([
            'user_id' => auth()->id(),
            'body' => $request->input('body'),
        ]);
        
         if (request()->expectsJson()) {
            return $reply->load('owner');
        }
        
        return back()->with('flash', 'You just replied this post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->update([
            'body' => $request->input('body')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        
        $reply->delete();
        
        if(request()->expectsJson())
        {
            return response(['status' => 'Reply deleted']);
        }
        
        return back();
    }
}
