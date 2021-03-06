@extends('layouts.app')

@section('content')
<div class="bg-light blog_area p_120">
    <div class="container pt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3 border-0 bg-transparent">
                    <div class="card-body py-0 px-1">
                        <avatar-form :user="{{ $profileUser }}"></avatar-form>
                        <span class="h6 text-muted text-uppercase">Writer | {{ $profileUser->created_at->toFormattedDateString() }}</span>
                        <br>
                        <a class="small" href="/profiles/{{ $profileUser->name }}/activity">Activity</a>
                        <div class="pb-4 mb-4"> </div>
                        <h5 class="mb-3 font-weight-bold">Latest</h5>
                        
                        @forelse($profileUser->posts as $post)
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title"><a class="text-dark" href="{{ $post->path() }}">{{ $post->title }}</a></h5>
                                <h6 class="card-subtitle mb-3 text-muted">{{ $post->creator->name }} | {{ $post->created_at->toFormattedDateString() }}</h6>
                                <p class="card-text">{!! substr($post->body, 0, 200) !!}...</p>
                                <span class="card-link">
                                    <i class="fa fa-comment-o fa-sm text-muted"></i>
                                    <small class="text-muted">{{ $post->replies_count }}</small>
                                </span>
                                <span class="card-link">
                                    <i class="fa fa-eye fa-sm text-muted"></i>
                                    <small class="text-muted">{{ $post->visits }}</small>
                                </span>
                            </div>
                        </div>
                        @empty
                            <h5 class="text-center mt-4 pt-4">{{ $profileUser->name }} hasn't pusblished any post yet.</h5>
                            <hr>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection