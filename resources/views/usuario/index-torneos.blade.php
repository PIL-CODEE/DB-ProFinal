<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/index-usuario.css')}}">
    <title>Torneos de tenis</title>
    <style>
        body {
            background-image: url("{{ asset('img/Torneos 2.jpeg') }}");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="nav1">
                <li><a href="#">Reservar</a></li>
                <li><a href="{{route('usuario.index-clases')}}">Academia Tennis</a></li>
                <li><a href="#">Torneos</a></li>
            </ul>
            <img src="{{asset('img/Logo Olympues Tennis Camp.jpg')}}" alt="">
            <ul class="nav2">
                <li><a href="">Ubicación</a></li>
                @if (Auth::check())
                    <li><a href="#">Cuenta de {{Auth::user()->name}}</a></li>
                    <li><a href="{{route('logout')}}">Salir</a></li>
                @else 
                    <li><a href="{{route('login')}}">Iniciar Sesión</a></li>
                    <li><a href="{{route('registro')}}">Registrate</a></li>
                @endif
            </ul>
        </nav>
    </header>
    <h1 class="title_torneos">TORNEOS</h1>
</body>
</html>