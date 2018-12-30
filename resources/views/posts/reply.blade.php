<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div class="card my-4" id="reply-{{ $reply->id }}">
        <div class="card-body">
            <div class="media text-muted">
                <img class="mr-2 rounded-circle" src="https://images.unsplash.com/photo-1544501616-6c71ff5438ec?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1900&q=80https://images.unsplash.com/photo-1514626585111-9aa86183ac98?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" alt="Profile" width="32" height="32">
                <div class="media-body">
                    <h6 class="mt-0"><a href="/profiles/{{ $reply->owner->name }}"><span>@</span>{{ $reply->owner->name }}</a>
                    <span class="d-block text-gray-dark pt-1">{{ $reply->created_at->diffForHumans() }}</span>
                    </h6>
                    <div v-if="editing">
                        <div class="form-group">
                            <textarea class="form-control mb-2" rows="4" v-model="body"></textarea>
                            <button @click="update" class="btn btn-outline-primary btn-sm">Update</button>
                            <button @click="editing = false" class="btn btn-outline-secondary btn-sm" title="Cancel">Cancel</button>
                        </div>
                    </div>
                    <div v-else v-text="body" style="font-size: .9rem"></div>
                    
                </div>
            </div>
            
            <form class="reply-icons" method="POST" action="/replies/{{ $reply->id }}/favorites">
                @csrf
                <button type="submit" title="Like" class="btn btn-link pt-4 pl-0 pb-0" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                    <span class=""><i class="far fa-thumbs-up fa-lg"></i></span>
                    <span class="btn-like">{{ $reply->favorites_count }}</span>
                </button>
            </form>
            @can('update', $reply)
                <!--Deleting reply-->
                <!--<form class="reply-icons" action="/replies/{{ $reply->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">-->
                <!--    @csrf-->
                <!--    @method('DELETE')-->
                <!--    <button type="submit" class="btn btn-link pt-4 pl-0 pb-0" title="Delete">-->
                <!--        <span class="btn-like text-danger"><i class="far fa-trash-alt fa-lg"></i></span>-->
                <!--    </button>-->
                <!--</form>-->
                <button class="btn btn-link pt-4 pl-0 pb-0" title="Delete" @click="destroy">
                    <span class="text-danger"><i class="far fa-trash-alt fa-lg"></i></span>
                </button>
                <!--Editing reply-->
                <button class="btn btn-link pt-4 pl-0 pb-0 float-md-right" title="Edit" @click="editing = true">
                    <span class=""><i class="far fa-edit fa-lg"></i></span>
                </button>
            @endcan
        </div>
    </div>
</reply>