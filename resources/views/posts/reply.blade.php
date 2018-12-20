<div class="card my-4" >
    <div class="card-body">
        <div class="media text-muted">
            <img class="mr-2 rounded-circle" src="https://images.unsplash.com/photo-1544501616-6c71ff5438ec?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1900&q=80https://images.unsplash.com/photo-1514626585111-9aa86183ac98?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" alt="Profile" width="32" height="32">
            <div class="media-body">
                <h6 class="mt-0"><a href="#"><span>@</span>{{ $reply->owner->name }}</a>
                <span class="d-block text-gray-dark pt-1">{{ $reply->created_at->diffForHumans() }}</span>
                </h6>
                <span style="font-size: .9rem">{{ $reply->body }}</span>
            </div>
        </div>
        
        <form method="POST" action="/replies/{{ $reply->id }}/favorites">
            @csrf
            <button type="submit" class="btn btn-link pt-4 pl-0 pb-0" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                <span class=""><i class="far fa-thumbs-up fa-lg"></i></span>
                <span class="btn-like">{{ $reply->favorites_count }}</span>
            </button>
        </form>
    </div>
</div>