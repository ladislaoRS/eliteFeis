@extends('layouts.opium')

@section('content')
@include('layouts.nav')
<div class="bg-light">
    <div class="container pt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 bg-transparent">
                    <div class="card-body pt-0 px-1">
                            @forelse($posts as $post)
                                <div class="card border-0 mb-4 bg-white p-3 rounded shadow-sm" id="posts">
                                    <div class="card-body py-0 px-0">
                                        <h6 class="text-uppercase mb-0"><a href="/posts/{{ $post->tag->slug }}" class="text-success">{{$post->tag->name}}</a></h6>
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
                                        <p class="card-text text-muted pt-3 mb-0">{{ $post->subtitle }}</p>
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
                                <hr>
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
                    <div class="card border-0 bg-white shadow-sm">
                        <div class="card-body">
                            <form method="GET" action="/posts/search">
                                <div class="col-auto">
                                    <div class="input-group pt-2">
                                        <input class="form-control" type="text" name="q" placeholder="Search Posts..." aria-label="Search"/>
                                        <div class="input-group-append border-success">
                                            <button class="btn btn-outline-success" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <a href="https://www.algolia.com/">
                                        <img class="float-right" alt="Algolia" src="/images/search-by-algolia-light.svg" width="100" height="30">
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
    
                    @if (count($trending))
                    <h5 class="mt-4 mb-3 pl-2 border-left border-secondary text-secondary" style="border-width: 3px !important;">Most Read </h5>
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
                                         <span style="font-size: .8rem"> By 
                                            <a href="/profiles/{{ $trend->creator }}" style="color: #212529"><u>{{ $trend->creator }}</u></a>
                                         </span>
                                         {!! ($loop->last ? "" : "<hr class='my-3'>") !!}
                                    </div>
                                 </li>
                                 @endforeach
                             </ul>
                        </div>
                    @endif
                    
                    <h5 class="mt-4 mb-3 pl-2 border-left border-secondary text-secondary" style="border-width: 3px !important;">Popular on Elitefeis </h5>
                    <div class="p-3 mb-3 bg-white shadow-sm rounded">
                        <ul class="list-unstyled mb-0" id="popular">
                             @foreach($popularity as $popular)
                                <li class="media py-3">
                                    <h2 class="mr-3 align-self-center text-muted">0{{ $loop->iteration }}</h2>
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase" style="font-size: .8rem">
                                            {{ $popular->tag->slug }}
                                         </span>
                                        <p class="my-0 post-index"><a href="{{ $popular->path() }}">{{ $popular->title }}</a></p>
                                         <span style="font-size: .8rem">
                                            <a href="/profiles/{{ $popular->creator->name }}" style="color: #212529"><u>{{ $popular->creator->name }}</u></a>
                                         </span><span class="text-muted" style="font-size: .8rem"> | {{ $popular->created_at->toFormattedDateString() }}</span>
                                         <br> 
                                         
                                    </div>
                                 </li>
                                 {!! ($popular === $popularity->last() ? "" : "<hr class='my-1'>") !!}
                             @endforeach
                         </ul>
                        <hr>
                        <ul class="list-inline text-center post-index">
                            <li class="list-inline-item"><a href="/about">About</a></li>
                            <li class="list-inline-item"><a href="#">Contact</a></li>
                            <li class="list-inline-item"><a href="#">Help</a></li>
                        </ul>
                    </div>
                </aside><!-- /.blog-sidebar -->
            </div>
        </div>
    </div>
</div>
@endsection