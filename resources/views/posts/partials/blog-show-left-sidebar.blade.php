<post :data="{{ $post }}" :initial-replies-count="{{ $post->replies_count }}" inline-template v-cloak>
    <div class="main_blog_details">
        <img class="img-fluid" src="{{ asset('/opium/img/blog/news-blog.jpg') }}" alt="">
       	<a href="#"><h4>{{ $post->title }} </h4></a>
       	<p style="font-size: 1.4rem" class="text-muted"> {{ $post->subtitle }}</p>
       	<div class="user_details">
       		<div class="float-left text-capitalize">
       			<a href="#">{{ $post->tag->name }}</a>
       			<!--<a href="#">Gadget</a>-->
       		</div>
       		<div class="float-right">
       			<div class="media">
       				<div class="media-body">
       					<h5>{{ $post->creator->name }}</h5>
       					<p>{{ $post->created_at->toFormattedDateString() }}</p>
       				</div>
       				<div class="d-flex">
       					<img src="{{ asset('/opium/img/blog/user-img.jpg') }}" alt="">
       				</div>
       			</div>
       		</div>
       	</div>
       	<!--<p style="line-height: 1.8rem; font-size: 1.2rem;">{!! $post->body !!}</p>-->
       	<div v-if="editing">
            <div class="form-group">
                <!--<textarea class="form-control mb-2" rows="8" v-model="body" style="line-height: 1.9rem; font-size: 1.25rem"></textarea>-->
                <wysiwyg v-model="body" class="mb-3"></wysiwyg>
                <button @click="update" class="btn btn-outline-primary btn-sm">Update</button>
                <button @click="editing = false" class="btn btn-outline-secondary btn-sm" title="Cancel">Cancel</button>
            </div>
        </div>
        <div v-else v-html="body" style="line-height: 1.9rem; font-size: 1.25rem; white-space: pre-wrap;"></div>
        @can('update', $post)
            <div class="actions text-right">
                <!--Editing reply-->
                <button class="btn btn-link btn-lg" title="Edit"  @click="editing = true">
                    <span class=""><i class="fa fa-edit"></i></span>
                </button>
                <!--Ajaxifying delete button-->
                <button class="btn btn-link btn-lg" title="Delete" @click="destroy">
                    <span class="text-danger"><i class="fa fa-trash"></i></span>
                </button>
            </div>
        @endcan
      	<div class="news_d_footer">
      		<a href="#"><i class="lnr lnr lnr-heart"></i>4 people like this</a>
      		<a class="justify-content-center ml-auto" href="#"><i class="lnr lnr lnr-bubble"></i>{{ $post->replies_count }} Comments</a>
      		<div class="news_socail ml-auto">
    			<a href="#"><i class="fa fa-facebook"></i></a>
    			<a href="#"><i class="fa fa-twitter"></i></a>
    			<a href="#"><i class="fa fa-youtube-play"></i></a>
    			<a href="#"><i class="fa fa-pinterest"></i></a>
    			<a href="#"><i class="fa fa-rss"></i></a>
    		</div>
      	</div>
    </div>
</post>
<div class="navigation-area">
   <div class="row">
        <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
            @if (!empty($post->previous()))
            <div class="thumb">
                <a href="#"><img class="img-fluid" src="{{ asset('/opium/img/blog/prev.jpg') }}" alt=""></a>
            </div>
            <div class="arrow">
                <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
            </div>
            <div class="detials">
                <p>Prev Post</p>
                <a href="#"><h4>{{ $post->previous()->title }}</h4></a>
            </div>
            @endif
        </div>
    <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
        @if (!empty($post->next()))
        <div class="detials">
            <p>Next Post</p>
            <a href="#"><h4>{{ $post->next()->title }}</h4></a>
        </div>
        <div class="arrow">
            <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
        </div>
        <div class="thumb">
            <a href="#"><img class="img-fluid" src="{{ asset('/opium/img/blog/next.jpg') }}" alt=""></a>
        </div>
        @endif
    </div>									
</div>
</div>

<!--Replies section-->
<replies @added="repliesCount++" @removed="repliesCount--"></replies>
