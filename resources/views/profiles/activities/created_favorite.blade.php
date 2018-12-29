<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <p class="card-title text-muted"> {{ $profileUser->name }} liked a reply
            <a href="{{ $activity->subject->favorited->path() }}">
                {{ $activity->subject->favorited->body }}    
            </a> {{ $activity->subject->created_at->diffForHumans() }}
        </p>
    </div>
</div>