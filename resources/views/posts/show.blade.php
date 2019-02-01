@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection
@section('content')
<post :data="{{ $post }}" :initial-replies-count="{{ $post->replies_count }}" inline-template v-cloak>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 border-0" id="post">
                <div class="card-body py-0 px-1">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <h6 class="card-subtitle mb-2 text-muted"> 
                        {{ $post->created_at->toFormattedDateString() }} by
                        <a href="/profiles/{{ $post->creator->name }}">{{ $post->creator->name }}</a>
                    </h6>
                    
                    <div class="mb-4"> </div>
                    
                    <div v-if="editing">
                        <div class="form-group">
                            <textarea class="form-control mb-2" rows="8" v-model="body" style="line-height: 1.9rem; font-size: 1.25rem"></textarea>
                            <button @click="update" class="btn btn-outline-primary btn-sm">Update</button>
                            <button @click="editing = false" class="btn btn-outline-secondary btn-sm" title="Cancel">Cancel</button>
                        </div>
                    </div>
                    <div v-else v-text="body" style="line-height: 1.9rem; font-size: 1.25rem; white-space: pre-wrap;"></div>

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
                    
                    <div class="py-2">
                        <hr>
                    </div>
                    <div class="bg-light p-3 my-2 rounded">
                        
                        <!--Replies section-->
                        @if($post->replies->isEmpty())
                            <div class="pb-3 text-center text-muted">This post has no replies yet.</div>
                        @else
                            <div class="">Responses</div>
                        @endif
                        
                       <replies @added="repliesCount++" @removed="repliesCount--"></replies>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <aside class="blog-sidebar">
                <div class="p-3 mb-3 bg-light rounded">
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
@endsection
