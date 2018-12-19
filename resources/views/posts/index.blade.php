@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-body pt-0">
                    @foreach($posts as $post)
                        <div class="card mb-4">
                            <div class="card-body py-2">
                                <h4 class="card-title"><a href="{{ $post->path() }}">{{ $post->title }}</a></h4>
                                <h6 class="card-subtitle mb-3 text-muted"> 
                                    {{ $post->created_at->toFormattedDateString() }} by
                                    <a href="#">{{ $post->creator->name }}</a>
                                </h6>
                                <p class="card-text lead">{{ substr($post->body, 0, 200) }} <a href="{{ $post->path() }}">...</a></p>
                                <a href="{{ $post->path() }}" class="card-link">
                                    <span class="">{{ $post->replies_count }}</span>
                                    <span class=""><i class="fas fa-reply"></i></span>
                                </a>
                                <a href="#" class="card-link">
                                    <span class=""><i class="fas fa-eye"></i></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <aside class="blog-sidebar">
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">About</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">Tags</h4>
                    <ol class="list-unstyled mb-0">
                        @foreach($tags as $tag)
                            <li class="text-capitalize"><a href="/posts/{{ $tag->slug }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ol>
                </div>
                <div class="p-3">
                    <h4 class="font-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                    </ol>
                </div>
            </aside><!-- /.blog-sidebar -->
        </div>
    </div>
</div>
@endsection
