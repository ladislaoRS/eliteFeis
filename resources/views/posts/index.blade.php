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
                                <h6 class="text-uppercase mb-0"><a href="/posts/{{ $post->tag->slug }}" class="text-muted">{{$post->tag->name}}</a></h6>
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
                    <h4 class="font-weight-bold">Popular on FeisElite</h4>
                    <hr>
                    <ul class="list-unstyled" id="popular">
                         @foreach($popularity as $popular)
                        <li class="media pb-3">
                            <!--<img class="mr-3 rounded-circle" src="https://images.unsplash.com/photo-1544501616-6c71ff5438ec?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1900&q=80https://images.unsplash.com/photo-1514626585111-9aa86183ac98?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" width="32" height="32" alt="Profile">-->
                            <h2 class="mr-3 align-self-center text-muted"></h2>
                            <div class="media-body">
                              <h5 class="mt-0 mb-1"><a href="{{ $popular->path() }}">{{ substr($popular->title, 0, 60) }}...</a></h5>
                             <span style="font-size: .95rem">{{ $popular->creator->name }} <br> {{ $popular->created_at->toFormattedDateString() }}</span>
                            </div>
                         </li>
                     </ul>
                     @endforeach
                </div>
                <div class="p-3">
                    <!--<h4 class="font-italic">Media</h4>-->
                    <hr>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#">Profile</a></li>
                        <li class="list-inline-item"><a href="#">Help</a></li>
                        <li class="list-inline-item"><a href="#">About</a></li>
                    </ul>
                </div>
            </aside><!-- /.blog-sidebar -->
        </div>
    </div>
</div>
@endsection
