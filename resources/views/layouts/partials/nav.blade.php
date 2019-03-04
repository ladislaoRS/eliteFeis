<nav class="navbar navbar-expand-lg navbar-light">
	<div class="container box_1620">
		<!-- Brand and toggle get grouped for better mobile display -->
		<a class="navbar-brand logo_h" href="index.html"><img src="{{ asset('opium/img/logo.png') }}" alt=""></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
			<ul class="nav navbar-nav menu_nav">
				<li class="nav-item active"><a class="nav-link" href="/">Home</a></li> 
				<!--<li class="nav-item"><a class="nav-link" href="#">Category</a></li>-->
				<li class="nav-item"><a class="nav-link" href="#">Archive</a></li>
				<!--<li class="nav-item submenu dropdown">-->
				<!--	<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>-->
				<!--	<ul class="dropdown-menu">-->
				<!--		<li class="nav-item"><a class="nav-link" href="#">Sinlge Blog</a></li>-->
				<!--		<li class="nav-item"><a class="nav-link" href="#">Elements</a></li>-->
				<!--	</ul>-->
				<!--</li> -->
				<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right header_social ml-auto">
				<li class="nav-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li class="nav-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
				@guest
                <li class="nav-item"><a class="nav-item" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @if (Route::has('register'))
                <li class="nav-item"><a class="nav-item" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @endif
                @else
				<li class="nav-item submenu dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
					<ul class="dropdown-menu">
						<li class="nav-item"><a class="nav-link" href="/posts/create"> + New Story</a></li>
						<li class="nav-item"><a class="nav-link" href="/profiles/{{ Auth::user()->name }}"> Profile</a></li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('logout') }} " 
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"> {{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
						</li>
					</ul>
				</li>
				@endguest
				<!--<li class="nav-item"><a href="#"><i class="fa fa-dribbble"></i></a></li>-->
				<!--<li class="nav-item"><a href="#"><i class="fa fa-behance"></i></a></li>-->
			</ul>
		</div> 
	</div>
</nav>