<!doctype html>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-image:url('https://i.ibb.co/TTsG7pY/backgr.png');     background-size: cover;
    height: max-content;">
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"
            style="    background-color: rgba(52, 144, 220, 0.5) !important;">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="https://i.ibb.co/SX4wRWw/nmn.png" style="height: 2rem; border-right: 1px solid #333;"
                            class="pr-3"></div>
                    <div class="pl-3"> GallArt</div>

                </a>


                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <div class="topnav align align-items-center">


                            @guest
                            @if (Route::has('login'))
                          
                            @endif

                            @if (Route::has('register'))
                            
                            @endif
                            @else
                            <div class="search-container ">
                                <form action="/profilech" method="GET">
                                    <input type="text" placeholder="Search..." name="category" required />

                                    <button type="submit" class="fa fa-search"></button>
                                    @foreach ($errors->all() as $message)
                                    {{ $message }}
                                    @endforeach
                                </form>



                            </div>
                            @endguest
                           

                        </div>


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <a class="navbar-brand d-flex" href="/d">

                            <div class="pl-3"> Discover </div>

                        </a>
                        <a class="navbar-brand d-flex" href="/">

                            <div class="pl-3"> Following </div>

                        </a>
                        <a class="navbar-brand d-flex" href="/profile/{{Auth::user()-> id}}">

                            <div class="pl-3"> Profile </div>

                        </a>


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>



                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>