<div class="blog_left_sidebar">
    @forelse($posts as $post)
        <article class="blog_style1">
        <div class="blog_img">
            <img class="img-fluid" src="{{ asset('opium/img/home-blog/blog-' . $loop->iteration) }}.jpg" alt="">
        </div>
        <div class="blog_text">
            <div class="blog_text_inner">
                <div class="cat">
                    <a class="cat_btn text-capitalize" href="/posts/{{ $post->tag->slug }}"> {{ $post->tag->name }}</a>
                    <a href="{{ $post->path() }}"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $post->created_at->toFormattedDateString() }}</a>
                    <a href="{{ $post->path() }}"><i class="fa fa-comments-o" aria-hidden="true"></i> {{ $post->replies_count }}</a>
                    <a href="{{ $post->path() }}"><i class="fa fa-eye" aria-hidden="true"></i> {{ $post->visits }}</a>
                </div>
                <a href="{{ $post->path() }}"><h4>{{ $post->title }}</h4></a>
                <p>{{ $post->subtitle }}</p>
                <a class="blog_btn" href="{{ $post->path() }}">Read More</a>
            </div>
        </div>
        </article>
    @empty
        <h5 class="text-center mt-4 pt-4">No posts have been published yet, <a href="/posts/create">write</a> your first post!</h5>
        <hr>
    @endforelse
    
    {{ $posts->links() }}
</div>