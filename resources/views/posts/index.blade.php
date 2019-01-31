@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-body pt-0 px-1">
                        @forelse($posts as $post)
                            <div class="card border-0 mb-4" id="posts">
                                <div class="card-body py-0 px-0">
                                    <h6 class="text-uppercase mb-0"><a href="/posts/{{ $post->tag->slug }}" class="text-muted">{{$post->tag->name}}</a></h6>
                                    <h4 class="card-title post-index"><a href="{{ $post->path() }}">
                                        @if (Auth::user() && !$post->hasUpdatesFor(Auth::user()))
                                            <span class="text-muted">
                                                {{ $post->title }}
                                            </span>
                                        @else
                                            {{ $post->title }}
                                        @endif
                                    </a></h4>
                                    <h6 class="card-subtitle mb-3 text-muted"> 
                                        {{ $post->created_at->toFormattedDateString() }} by
                                        <a href="/profiles/{{ $post->creator->name }}">{{ $post->creator->name }}</a>
                                    </h6>
                                    <p class="card-text lead text-muted">{{ substr($post->body, 0, 200) }} <a href="{{ $post->path() }}">...</a></p>
                                    <a href="{{ $post->path() }}" class="card-link">
                                        <span class=""><i class="far fa-comment"></i></span>
                                        <span class="">{{ $post->replies_count }}</span>
                                    </a>
                                    <a href="#" class="card-link">
                                        <span class=""><i class="far fa-eye"></i></span>
                                    </a>
                                </div>
                            </div>
                            <!--<hr>-->
                            {!! ($post === $posts->last() ? "" : "<hr />") !!}
                        @empty
                            <h5 class="text-center mt-4 pt-4">No posts have been published yet, <a href="/posts/create">write</a> your first post!</h5>
                            <hr>
                        @endforelse
                    <div class="pb-3"></div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <aside class="blog-sidebar">
                <a href="/posts/create" class="btn btn-primary btn-lg btn-block">
                    Write a New Post
                </a>
                <div class="pb-4"></div>
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">Bookmarked</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>

                <div class="p-4">
                    <h4 class="">Popular on FeisElite</h4>
                    <hr>
                    <ul class="list-unstyled" id="popular">
                         @foreach($popularity as $popular)
                        <li class="media pb-3">
                            <h2 class="mr-3 align-self-center text-muted"></h2>
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><a href="{{ $popular->path() }}">{{ substr($popular->title, 0, 60) }}...</a></h5>
                                 <span style="font-size: .95rem">
                                    <a href="/profiles/{{ $popular->creator->name }}" style="color: #212529">{{ $popular->creator->name }}</a>
                                 </span>
                                 <br> 
                                 <span class="text-muted" style="font-size: .9rem">{{ $popular->created_at->toFormattedDateString() }}</span>
                            </div>
                         </li>
                     </ul>
                     @endforeach
                    <hr>
                    <ul class="list-inline text-center">
                        <li class="list-inline-item"><a href="#">About</a></li>
                        <li class="list-inline-item"><a href="#">Contact</a></li>
                        <li class="list-inline-item"><a href="#">Help</a></li>
                    </ul>
                </div>
            </aside><!-- /.blog-sidebar -->
        </div>
    </div>
</div>
@endsection
