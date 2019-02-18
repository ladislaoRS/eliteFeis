<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=PT+Serif|Source+Sans+Pro" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        
        @yield('head')
    </head>
    <body class="bg-white">
        <div id="app">
            <header class="py-3 border-bottom">
                <div class="container">
                    <div class="row flex-nowrap justify-content-between align-items-center">
                        <div class="col-4 pt-1">
                            <a class="navbar-brand text-dark" href="{{ url('/') }}">
                                <span class="h3">{{ config('app.name', 'Laravel') }}</span>
                            </a>
                        </div>
                        
                        <div class="col-4 d-flex justify-content-end align-items-center">
                            @if(Auth::check())
                            <a class="text-muted mx-2" href="#">
                                <span><i class="fas fa-search"></i></span>
                            </a>
                            <user-notifications></user-notifications>
                            @endif
                            <!-- Authentication Links -->
                            @guest
                            <a class="text-muted mx-2" href="{{ route('login') }}">{{ __('Login') }}</span></a>
                            @if (Route::has('register'))
                            <a class="btn btn-outline-success mx-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                            @else
                            <div class="dropdown mx-2">
                                <a class="text-muted h5 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right text-uppercase" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item my-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item my-2" href="/profiles/{{ Auth::user()->name }}">Profile</a>
                                    <a class="dropdown-item my-2" href="/posts/create">New Post</a>
                                </div>
                            </div>
                            @endguest
                        </div>
                    </div>
                    <!--<hr class="my-1">-->
                    
                </div>
            </header>
            
            <main class="" style="min-height: 500px">
                @yield('content')
            </main>
            <footer class="blog-footer">
                <p>© Creaintel {{ date('Y') }}. All rights reserved.</p>
                <p>
                    <a href="#" class="btn btn-primary">Back to top</a>
                </p>
            </footer>
            <flash message="{{ session('flash') }}"></flash>
        </div>
        <script>
        window.App = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => Auth::user(),
        'signedIn' => Auth::check()
        ]) !!};
        </script>
    </body>
</html>