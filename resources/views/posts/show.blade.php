@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 border-0" id="post">
                <div class="card-body py-0 px-1">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <h6 class="card-subtitle mb-4 text-muted"> 
                        {{ $post->created_at->toFormattedDateString() }} by
                        <a href="/profiles/{{ $post->creator->name }}">{{ $post->creator->name }}</a>
                    </h6>
                    <p class="card-tex" style="line-height: 1.9rem; font-size: 1.25rem">{!! nl2br($post->body) !!}</p>
                    @can('update', $post)
                    <form action="{{ $post->path() }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="btn btn-outline-danger py-1 prevent"
                            title="Delete Post"
                        > Delete
                        </button>
                    </form>
                    @endcan
                    
                    <div class="py-2">
                        <hr>
                    </div>
                    <div class="bg-light p-3 my-2 rounded">
                        
                        <!--Replies section-->
                        @if($replies->isEmpty())
                            <div class="pb-3 text-center text-muted">This post has no replies yet.</div>
                        @else
                            <div class="">Responses</div>
                        @endif
                        
                        @foreach($replies as $reply)
                            @include('posts.reply')
                        @endforeach
                        <div class="">{{ $replies->links() }}</div>
                        
                        @if (Auth::check())
                            <form method="POST" action="{{ $post->path() }}/replies">
                                @csrf
                                <div class="form-group">
                                    <textarea name="body" class="form-control" id="body" placeholder="Write a response..." rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <span class=""><i class="fas fa-reply fa-sm"></i></span>
                                    Reply
                                </button>
                            </form>
                        @else
                            <p class="text-center">Please <a href="{{ route('login') }}">Sign In</a> to participate in this discussion.</p>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <aside class="blog-sidebar">
                <div class="p-3 mb-3 bg-light rounded">
                <h4 class="font-italic">About</h4>
                <p class="mb-0">
                    This post was published {{ $post->created_at->diffForHumans() }} by 
                    <a href="/profiles/{{ $post->creator->name }}">{{ $post->creator->name }}</a>, and currently has {{ $post->replies_count }} {{ str_plural('comment', $post->replies_count) }}.
                </p>
                </div>
            </aside><!-- /.blog-sidebar -->
        </div>
    </div>
</div>
@endsection
