@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 border-0">
                <div class="card-body py-0 px-1">
                    <span class="h1">{{ $profileUser->name }}</span>
                    <br>
                    <span class="h6 text-muted text-uppercase">Writer | {{ $profileUser->created_at->toFormattedDateString() }}</span>
                    <hr class="pb-4 mb-4">
                    <h5 class="mb-3 font-weight-bold">Latest</h5>
                    @foreach($profileUser->posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ $post->path() }}">{{ $post->title }}</a></h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $post->creator->name }} | {{ $post->created_at->toFormattedDateString() }}</h6>
                            <p class="card-text">{{ substr($post->body, 0, 200) }}...</p>
                            <span class="card-link">
                                <i class="far fa-comment"></i>
                                <span class="">{{ $post->replies_count }}</span>
                            </span>
                            <span class="card-link">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection