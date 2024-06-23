<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/index-usuario.css')}}">
    <title>Clases de Tenis</title>
    <style>
        body {
            background-image: url("{{ asset('img/Canchas de tenis.jpeg') }}");
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
                <li><a href="#">Academia Tennis</a></li>
                <li><a href="#">Torneos</a></li>
            </ul>
            <img src="{{asset('img/Logo Olympues Tennis Camp.jpg')}}" alt="">
            <ul class="nav2">
                <li><a href="">Ubicación</a></li>
                <li><a href="#">Iniciar Sesión</a></li>
                <li><a href="#">Registarse</a></li>
            </ul>
        </nav>
    </header>
    <h1>CLASES ACTIVAS</h1>
    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Instructor</th>
                <th>Cupo totales</th>
                <th>Cupos disponibles</th>
                <th>Duración</th>
                <th>Fecha de inicio</th>
                <th>Hora de inicio</th>
                <th>Hora fin</th>
                <th>Costo de inscripción</th>
                <th></th>
            </tr>   
        </thead>
        <tbody>
            @foreach ($clases as $clase)
            @if ($clase->estado == "Activo")
            <tr>
                <td>{{$clase->categoria}}</td>
                <td>{{$clase->instructor}}</td>
                <td>{{$clase->cupos_totales}}</td>
                <td>{{$clase->cupos_disponibles}}</td>
                <td>{{$clase->duracion}}</td>
                <td>{{$clase->fecha_inicio}}</td>
                <td>{{$clase->hora_inicio}}</td>
                <td>{{$clase->hora_fin}}</td>
                <td>S/ {{$clase->costo_inscripcion}}</td>
                <td>
                    <a href="{{route('usuario.inscribirse', $clase->id)}}"><button><b>Inscribirme</b></button></a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>