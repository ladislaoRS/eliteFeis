<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=PT+Serif|Source+Sans+Pro" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.11.1/trix.css">
        @yield('head')
        <!-- Scripts -->
        <script>
            window.App = {!! json_encode([
                'csrfToken' => csrf_token(),
                'user' => Auth::user(),
                'signedIn' => Auth::check()
            ]) !!};
        </script>
    </head>
    <body class="bg-white">
        <div id="app">
            <header class="mt-4">
            	<div class="main_menu">
            		@include('layouts.partials.app-nav')
            	</div>
            </header>
            
            @yield('content')

            <flash message="{{ session('flash') }}"></flash>
        </div>
        <!--@include('layouts.partials.footer-scripts')-->
    </body>
</html>