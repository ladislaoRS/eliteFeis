@extends('layouts.app')

@section ('head')
     @include('layouts.partials.head')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')
    <div class="blog_area p_120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="pb-4">New Post</h2>
    
                    <div class="card">
                        <!--<div class="card-header">Create a New Post</div>-->
    
                        <div class="card-body">
                            <form method="POST" action="/posts">
                               @csrf
                               <div class="form-group">
                                    <label for="tag_id">Tag</label>
                                    <select name="tag_id" id="tag_id" class="form-control" required>
                                        <option value="">Select tag...</option>
                                        @foreach (App\Tag::all() as $tag)
                                            <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="subtitle">Subtitle:</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}" required>
                                </div>
    
                                <div class="form-group">
                                    <label for="body">Body:</label>
                                    <!--<textarea name="body" id="body" class="form-control" rows="8" required>{{ old('body') }}</textarea>-->
                                    <wysiwyg class="mt-4 wysiwyg-scroll" name="body"></wysiwyg>
                                </div>
                                
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                                </div>
    
                                <button type="submit" class="btn btn-primary">Publish</button>
                                
                                @if ($errors->any())
                                 <hr>
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection