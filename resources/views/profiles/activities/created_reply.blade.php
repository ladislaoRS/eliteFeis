<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <p class="card-title text-muted"> {{ $profileUser->name }} replied to 
            <a href="{{ $activity->subject->post->path() }}">
                {{ $activity->subject->post->title }}    
            </a> {{ $activity->subject->created_at->diffForHumans() }}
        </p>
    </div>
</div>