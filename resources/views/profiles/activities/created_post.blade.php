<div class="card mb-3 border-0 shadow-sm">
    <div class="card-body">
        <p class="card-title text-muted"> {{ $profileUser->name }} published
            <a href="{{ $activity->subject->path() }}">
                {{ $activity->subject->title }}    
            </a> {{ $activity->subject->created_at->diffForHumans() }}
        </p>
    </div>
</div>