@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 bg-transparent">
                <div class="card-body pt-0 px-1">
                        @forelse($posts as $post)
                            <div class="card border-0 mb-3 bg-white p-3 rounded shadow-sm" id="posts">
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
                                    <h6 class="card-subtitle mb-3 text-muted post-index"> 
                                        {{ $post->created_at->toFormattedDateString() }} by
                                        <a href="/profiles/{{ $post->creator->name }}"><u>{{ $post->creator->name }}</u></a>
                                    </h6>
                                    <p class="card-text pt-3 mb-0 pr-5">{{ $post->subtitle }}</p>
                                    <div class="">
                                        <a class="btn btn-link pl-0" href="{{ $post->path() }}"><span class="text-success"> Read more...</span></a>
                                    </div>
                                    <hr class="my-2">
                                    <a href="{{ $post->path() }}" class="card-link text-muted">
                                        <span class=""><i class="far fa-comment fa-sm"></i></span>
                                        <small>{{ $post->replies_count }}</small>
                                    </a>
                                    <span class="card-link text-muted">
                                        <span class=""><i class="far fa-eye fa-sm"></i></span>
                                        <small>{{ $post->visits }}</small>
                                    </span>
                                </div>
                            </div>
                            <!--<hr>-->
                            <!--{!! ($post === $posts->last() ? "" : "<hr />") !!}-->
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
                <a href="/posts/create" class="btn btn-success btn-lg btn-block shadow">
                    Write a New Post
                </a>
                <!--<div class="pb-4"></div>-->
                @if (count($trending))
                
                <h5 class="mt-5 mb-3 font-weight-bold pl-2 border-left border-dark" style="border-width: 5px !important;">Most Read </h5>
                    <div class="p-3 mb-3 bg-white shadow-sm rounded">
                        <ul class="list-unstyled mb-0">
                             @foreach($trending as $trend)
                             
                            <li class="media pb-0">
                                <h3 class="mr-3 align-self-center text-muted">0{{ $loop->iteration }}</h3>
                                <div class="media-body">
                                    <span class="text-muted text-uppercase" style="font-size: .8rem">
                                        {{ $trend->tag_slug }}
                                     </span>
                                    <p class="my-0 post-index"><a href="{{ url($trend->path) }}">{{ $trend->title }}</a></p>
                                     <span style="font-size: .8rem">
                                        <a href="/profiles/{{ $trend->creator }}" style="color: #212529"><u>by {{ $trend->creator }}</u></a>
                                     </span>
                                     {!! ($loop->last ? "" : "<hr class='my-2'>") !!}
                                </div>
                             </li>
                             @endforeach
                         </ul>
                    </div>
                @endif
                
                <h5 class="mt-5 mb-3 font-weight-bold pl-2 border-left border-dark" style="border-width: 5px !important;">Popular on Elitefeis </h5>
                <div class="p-3 bg-white shadow-sm rounded">
                    <ul class="list-unstyled mb-0" id="popular">
                         @foreach($popularity as $popular)
                            <li class="media pb-2">
                                <!--<h2 class="mr-3 align-self-center text-muted">0{{ $loop->iteration }}</h2>-->
                                <div class="media-body">
                                    <span class="text-muted text-uppercase" style="font-size: .8rem">
                                        {{ $popular->tag->slug }}
                                     </span>
                                    <p class="my-0 post-index"><a href="{{ $popular->path() }}">{{ $popular->title }}</a></p>
                                     <span style="font-size: .8rem">
                                        <a href="/profiles/{{ $popular->creator->name }}" style="color: #212529"><u>{{ $popular->creator->name }}</u></a>
                                     </span>
                                     <br> 
                                     <span class="text-muted" style="font-size: .9rem">{{ $popular->created_at->toFormattedDateString() }}</span>
                                </div>
                             </li>
                             {!! ($popular === $popularity->last() ? "" : "<hr class='my-1'>") !!}
                         @endforeach
                     </ul>
                    <hr>
                    <ul class="list-inline text-center post-index">
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
