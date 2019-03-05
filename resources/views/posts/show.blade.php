@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
    @include('layouts.partials.head')
@endsection
@section('content')

<!--Include Nav Bar-->
@include('layouts.nav')
 <!--================Blog Area =================-->
        <section class="blog_area single-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
       					@include('posts.partials.blog-show-left-sidebar')
        			</div>
                    <div class="col-lg-4">
                        @include('posts.partials.blog-right-sidebar')
                    </div>
                </div>
            </div>
        </section>
        @include('layouts.partials.footer')
        <!--================Blog Area =================-->
    @endsection