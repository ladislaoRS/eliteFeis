<!--Opium Layout-->
@extends('layouts.opium')

<!--Main content-->
@section('content')
    
<!--Nav Bar-->
@include('layouts.nav')

<!-- Home Banner Area -->
@include('posts.partials.banner')

<!--================Blog Area =================-->
<section class="blog_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @include('posts.partials.blog-left-sidebar')
            </div>
            <div class="col-lg-4">
                @include('posts.partials.blog-right-sidebar')
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->
@endsection
