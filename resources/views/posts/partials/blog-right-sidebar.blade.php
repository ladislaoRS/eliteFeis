<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <a href="https://www.algolia.com/">
            <img class="float-right pr-1" alt="Algolia" src="/images/search-by-algolia-light.svg" width="100" height="30">
        </a>
        <form method="GET" action="/posts/search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Posts">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                </span>
            </div><!-- /input-group -->
        </form>
        <div class="br"></div>
    </aside>
    
    @if (Auth::user())
    <aside class="single_sidebar_widget author_widget">
        <img class="author_img img-fluid rounded border" src="{{ asset('opium/img/blog/author.png') }}" alt="">
        <h4>{{ Auth::user()->name }}</h4>
        <p>Writer</p>
        <p>Without words, without writing and without books there would be no history, there could be no concept of humanity.</p>
        <div class="social_icon">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>
            <a href="#"><i class="fa fa-behance"></i></a>
        </div>
        <div class="br"></div>
    </aside>
    @endif
    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title">Popular Posts</h3>
        @foreach($popularity as $popular)
        <div class="media post_item">
            <img src="{{ asset('opium/img/blog/popular-post/post' . $loop->iteration) }}.jpg" alt="post">
            <div class="media-body">
                <a href="{{ $popular->path() }}"><h3>{{ $popular->title }}</h3></a>
                <p>{{ $popular->created_at->diffForHumans() }}</p>
            </div>
        </div>
        @endforeach
        <div class="br"></div>
    </aside>
    <aside class="single-sidebar-widget newsletter_widget">
        <h4 class="widget_title">Newsletter</h4>
        <div class="form-group d-flex flex-row">
            <div class="input-group">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
            </div>
            <a href="#" class="bbtns"><i class="lnr lnr-arrow-right"></i></a>
        </div>	
        <div class="br"></div>							
    </aside>
    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Post Catgories</h4>
        <ul class="list cat-list">
            @foreach($tags as $tag)
            <li>
                <a href="/posts/{{ $tag->slug }}" class="d-flex justify-content-between text-capitalize">
                    <p>{{ $tag->name }}</p>
                    <p>{{ $tag->posts_count }}</p>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>
</div>