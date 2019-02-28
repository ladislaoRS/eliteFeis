<!--================Home Banner Area =================-->
<section class="home_banner_area">
	<div class="container">
		@unless(empty($trending))
		<div class="row">
			<div class="col-lg-5"></div>
			<div class="col-lg-7">
				<div class="blog_text_slider owl-carousel">
				@foreach($trending as $trend)
					<div class="item">
						<div class="blog_text">
							<div class="cat">
								<a class="cat_btn text-capitalize">{{ $trend->tag_slug }}</a>
								<a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($trend->created->date)->diffForHumans() }}</a>
								<a href="{{ url($trend->path) }}"><i class="fa fa-comments-o" aria-hidden="true"></i> {{ $trend->comments }}</a>
							</div>
							<a href="{{ url($trend->path) }}"><h4>{{ $trend->title }}</h4></a>
							<p>{{ $trend->subtitle }}</p>
							<a class="blog_btn" href="{{ url($trend->path) }}">Read More</a>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>
		@endunless
	</div>
</section>
<!--================End Home Banner Area =================-->