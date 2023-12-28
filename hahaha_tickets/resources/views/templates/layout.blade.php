<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaHaHa Tickets</title>
    <link rel="icon" href="{{ asset('icon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('app.css') }}" type="text/css">
</head>
<body>
    <div class="header">
        <a href="{{ route('home') }}"><img src="{{ asset('icon.ico') }}" alt="Icon" class="logo-icon"></a>
        <ul class="menu">
            <li><a href="{{ route('home') }}">Evenimente</a></li>
            <li><a href="{{ route('artist')}}">Artisti</a></li>
            <li><a href="#">Bilete</a></li>
            <li><a href="#">Utilizator</a></li>
            <li><a href="{{ route('despre') }}">Despre</a></li>
        </ul>
    </div>
    @yield('content')
</body>
</html>
