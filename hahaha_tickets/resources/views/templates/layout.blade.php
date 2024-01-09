<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaHaHa Tickets</title>
    <link rel="icon" href="{{ asset('icon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('app.css') }}" type="text/css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="header">
        <a href="{{ route('home') }}"><img src="{{ asset('icon.ico') }}" alt="Icon" class="logo-icon"></a>
        <ul class="menu">
            <li><a href="{{ route('show_event') }}">Evenimente</a></li>
            <li><a href="{{ route('artist')}}">Artisti</a></li>
            <li><a href="{{ route('show-tickets') }}">Bilete</a></li>
            <li><a href="{{ route('despre') }}">Despre</a></li>
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
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
    @yield('content')
</body>
</html>
