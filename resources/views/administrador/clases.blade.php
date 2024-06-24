<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/index-admi.css')}}">
    <title>Clases de Tenis</title>
    <script>
        function handleSelectChange(event) {
            var selectedValue = event.target.value;
            if (selectedValue) {
                document.getElementById('redirectForm').action = selectedValue;
                document.getElementById('redirectForm').submit();
            }
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <ul class="ul1">
                <li><a>Inicio</a></li>
            </ul>
            <img src="{{asset('img/Logo Olympues Tennis Camp.jpg')}}" alt="">
            <ul class="ul2">
                <li><a href="{{route('administrador.register-class')}}">Registrar clase de tenis</a></li>
            </ul>
        </nav>
    </header>
    <h1>CLASES ACTIVAS</h1>
    <table>
        <thead>
            <tr>
                <th>Id clase</th>
                <th>Categoria</th>
                <th>Instructor</th>
                <th>Cupo totales</th>
                <th>Cupos disponibles</th>
                <th>Duración</th>
                <th>Fecha de inicio</th>
                <th>Hora de inicio</th>
                <th>Hora fin</th>
                <th>Costo de inscripción</th>
                <th>Estado</th>
                <th></th>
            </tr>   
        </thead>
        <tbody>
            @foreach ($clases as $clase)
            @if ($clase->estado == "Activo")
            <tr>
                <td>{{$clase->id}}</td>
                <td>{{$clase->categoria}}</td>
                <td>{{$clase->instructor}}</td>
                <td>{{$clase->cupos_totales}}</td>
                <td>{{$clase->cupos_disponibles}}</td>
                <td>{{$clase->duracion}}</td>
                <td>{{$clase->fecha_inicio}}</td>
                <td>{{$clase->hora_inicio}}</td>
                <td>{{$clase->hora_fin}}</td>
                <td>S/ {{$clase->costo_inscripcion}}</td>
                <td>{{$clase->estado}}</td>
                <td>
                    <a href="{{route('administrador.desactivar-estado', $clase->id)}}"><button>Desactivar</button></a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <h1>CLASES TERMINADAS</h1>
    <table>
        <thead>
            <tr>
                <th>Id clase</th>
                <th>Categoria</th>
                <th>Instructor</th>
                <th>Cupo totales</th>
                <th>Cupos disponibles</th>
                <th>Duración</th>
                <th>Fecha de inicio</th>
                <th>Hora de inicio</th>
                <th>Hora fin</th>
                <th>Costo de inscripción</th>
                <th>Estado</th>
                <th></th>
            </tr>   
        </thead>
        <tbody>
            @foreach ($clases as $clase)
            @if ($clase->estado == "Terminado")
            <tr>
                <td>{{$clase->id}}</td>
                <td>{{$clase->categoria}}</td>
                <td>{{$clase->instructor}}</td>
                <td>{{$clase->cupos_totales}}</td>
                <td>{{$clase->cupos_disponibles}}</td>
                <td>{{$clase->duracion}}</td>
                <td>{{$clase->fecha_inicio}}</td>
                <td>{{$clase->hora_inicio}}</td>
                <td>{{$clase->hora_fin}}</td>
                <td>S/ {{$clase->costo_inscripcion}}</td>
                <td>{{$clase->estado}}</td>
                <td>
                    <form id="redirectForm" method="GET">
                        @csrf
                        <select onchange="handleSelectChange(event)">
                            <option>Opciones</option>
                            <option value="{{route('administrador.activar-estado', $clase->id)}}">Activar</option>
                            <option value="{{route('administrador.edit-class', $clase->id)}}">Editar</option>
                            <option value="{{route('administrador.delete-classes', $clase->id)}}">Eliminar</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>