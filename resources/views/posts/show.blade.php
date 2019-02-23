@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection
@section('content')
@include('layouts.nav')
<div class="bg-light pt-3">
    <post :data="{{ $post }}" :initial-replies-count="{{ $post->replies_count }}" inline-template v-cloak>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mb-4 border-0 bg-white shadow-sm p-3" id="post">
                    <div class="card-body py-0 px-1">
                        <h1 class="card-title">{{ $post->title }}</h1>
                        <h4 class="card-title text-muted py-2">{{ $post->subtitle }}</h4>
                        <div class="media">
                            <img src="{{ $post->creator->avatar_path }}" class="mr-3 rounded-circle" alt="{{ $post->creator->name }}" width="50" height="50">
                            <div class="media-body">
                                <a href="/profiles/{{ $post->creator->name }}">{{ $post->creator->name }}</a>
                                <a class="btn btn-outline-success py-0 btn-sm mx-2" href="#">Follow</a>
                                <h6 class="card-subtitle my-1 text-muted">{{ $post->created_at->toFormattedDateString() }}</h6>
                            </div>
                        </div>
                        <div class="mb-5"> </div>
                        
                        <div v-if="editing">
                            <div class="form-group">
                                <!--<textarea class="form-control mb-2" rows="8" v-model="body" style="line-height: 1.9rem; font-size: 1.25rem"></textarea>-->
                                <wysiwyg v-model="body"></wysiwyg>
                                <button @click="update" class="btn btn-outline-primary btn-sm">Update</button>
                                <button @click="editing = false" class="btn btn-outline-secondary btn-sm" title="Cancel">Cancel</button>
                            </div>
                        </div>
                        <div v-else v-html="body" style="line-height: 1.9rem; font-size: 1.25rem; white-space: pre-wrap;"></div>
                        @can('update', $post)
                        <div class="actions text-right">
                            <!--Editing reply-->
                            <button class="btn btn-link pt-4 pl-0 pb-0" title="Edit"  @click="editing = true">
                            <span class=""><i class="far fa-edit"></i></span> Edit
                            </button>
                            
                            <!--Ajaxifying delete button-->
                            <button class="btn btn-link pt-4 pl-0 pb-0" title="Delete" @click="destroy">
                            <span class="text-danger"><i class="far fa-trash-alt"></i> Delete</span>
                            </button>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="card p-0 border-0 bg-transparent">
                    <!--Replies section-->
                    @if($post->replies->isEmpty())
                    <div class="pb-3 text-center text-muted">This post has no replies yet.</div>
                    @else
                    <div class="mt-3">Responses</div>
                    @endif
                    <replies @added="repliesCount++" @removed="repliesCount--"></replies>
                </div>
            </div>
            <div class="col-md-3">
                <aside class="blog-sidebar">
                    <div class="p-3 mb-3 bg-white rounded shadow-sm">
                        <h4 class="font-italic">About</h4>
                        <p class="mb-2">
                            This post was published {{ $post->created_at->diffForHumans() }} by
                            <a href="/profiles/{{ $post->creator->name }}">{{ $post->creator->name }}</a>, and currently has <span v-text="repliesCount"></span> {{ str_plural('comment', $post->replies_count) }}.
                        </p>
                        @if (Auth::check())
                        <subscribe-button :active="{{ json_encode($post->isSubscribedTo) }}"></subscribe-button>
                        @endif
                    </div>
                    </aside><!-- /.blog-sidebar -->
                </div>
            </div>
        </div>
    </post>
</div>

    @endsection