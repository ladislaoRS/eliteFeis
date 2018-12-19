<div id="sidebar" class="nav flex-column nav-pills" aria-orientation="vertical" >
    
	@if (auth()->check())
		<a class="nav-link" href="/posts/?by={{ auth()->user()->name }}">
		<span class="icon pr-2"><i class="fa fa-inbox fa-lg"></i></span> My Threads
	</a>
	@endif
	<a class="nav-link" href="/posts">
		<span class="icon pr-4"><i class="fa fa-inbox fa-lg"></i></span>All
	</a>
	<a class="nav-link" href="/posts?popular=1">
		<span class="icon pr-4"><i class="fa fa-fire fa-lg"></i></span>Popular
	</a>
	<a class="nav-link" href="#">
		<span class="icon pr-4"><i class="fa fa-star fa-lg"></i></span>Important
	</a>
	<a class="nav-link" href="#">
		<span class="icon pr-4"><i class="fa fa-history fa-lg"></i></span>History
	</a>
</div>
<hr>	
<a href="posts/create" class="btn btn-success btn-block">New Thread</a>