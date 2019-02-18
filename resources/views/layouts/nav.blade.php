<div class="container">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
        @if(Auth::check())
            <a class="p-2 text-dark text-uppercase text-decoration-none" href="/posts?by={{ Auth::user()->name }}">My Posts</a>
        @endif
            <a class="p-2 text-success text-uppercase text-decoration-none" href="/posts">All</a>
            <a class="p-2 text-muted text-uppercase text-decoration-none" href="/posts?popular=1">Popular</a>
        @foreach($tags as $tag)
            <a class="p-2 text-muted text-uppercase text-decoration-none" href="/posts/{{ $tag->slug }}">{{ $tag->name }} </a>
        @endforeach
        </nav>
    </div>
</div>