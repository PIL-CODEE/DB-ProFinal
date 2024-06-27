<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/index-admi.css')}}">
    <title>Torneos de tenis</title>
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
                <li><a href="{{route('administrador.register-torneo')}}">Registrar torneo de tenis</a></li>
            </ul>
        </nav>
    </header>
    <h1>TORNEOS ACTIVOS</h1>
    <table>
        <thead>
            <tr>
                <th>Id torneo</th>
                <th>Categoria</th>
                <th>Organizador</th>
                <th>Nombre del torneo</th>
                <th>Modalidad</th>
                <th>Cupos totales</th>
                <th>Cupos disponibles</th>
                <th>Fecha de inicio</th>
                <th>Hora de inicio</th>
                <th>Costo de inscripción</th>
                <th>Estado</th>
                <th></th>
            </tr>   
        </thead>
        <tbody>
            @foreach ($torneos as $torneo)
            @if ($torneo->estado == "Activo")
            <tr>
                <td>{{$torneo->id}}</td>
                <td>{{$torneo->categoria}}</td>
                <td>{{$torneo->organizador}}</td>
                <td>{{$torneo->nombre_torneo}}</td>
                <td>{{$torneo->modalidad}}</td>
                <td>{{$torneo->cupos_totales}}</td>
                <td>{{$torneo->cupos_disponibles}}</td>
                <td>{{$torneo->fecha_inicio}}</td>
                <td>{{$torneo->hora_inicio}}</td>
                <td>S/ {{$torneo->costo_inscripcion}}</td>
                <td>{{$torneo->estado}}</td>
                <td>
                    <a href="{{route('administrador.desactivar-estado', $torneo->id)}}"><button>Desactivar</button></a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <h1>TORNEOS TERMINADOS</h1>
    <table>
        <thead>
            <tr>
                <th>Id torneo</th>
                <th>Categoria</th>
                <th>Organizador</th>
                <th>Nombre del torneo</th>
                <th>Modalidad</th>
                <th>Cupos totales</th>
                <th>Cupos disponibles</th>
                <th>Fecha de inicio</th>
                <th>Hora de inicio</th>
                <th>Costo de inscripción</th>
                <th>Estado</th>
                <th></th>
            </tr>   
        </thead>
        <tbody>
            @foreach ($torneos as $torneo)
            @if ($torneo->estado == "Terminado")
            <tr>
                <td>{{$torneo->id}}</td>
                <td>{{$torneo->categoria}}</td>
                <td>{{$torneo->organizador}}</td>
                <td>{{$torneo->nombre_torneo}}</td>
                <td>{{$torneo->modalidad}}</td>
                <td>{{$torneo->cupos_totales}}</td>
                <td>{{$torneo->cupos_disponibles}}</td>
                <td>{{$torneo->fecha_inicio}}</td>
                <td>{{$torneo->hora_inicio}}</td>
                <td>S/ {{$torneo->costo_inscripcion}}</td>
                <td>{{$torneo->estado}}</td>
                <td>
                    <form id="redirectForm" method="GET">
                        @csrf
                        <select onchange="handleSelectChange(event)">
                            <option>Opciones</option>
 
                        </select>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <h1 class="h11">INSCRIPCIONES</h1>
    <form method="GET" class="form2" action="{{route('administrador.torneos')}}">
        <div class="row">
            <div class="input-gruop"> 
                <label for="idtorneoInput">ID del torneo: </label>
                <input type="text" id="idtorneoInput" name="id_torneo">
            </div>
            <div class="input-gruop">
                <label for="nombreInput">Nombre del inscrito:</label>
                <input type="text" id="nombreInput" name="nombre_inscrito">
            </div>
            <div class="input-gruop">
                <button type="submit" class="button2">Buscar</button>
            </div>
        </div>
    </form>
    <table class="table2">
        <thead>
            <tr>
                <th>ID TORNEO</th>
                <th>NOMBRE DEL INSCRITO</th>
            </tr>
        </thead>
        @if (request()->has('id_torneo') && trim(request()->input('id_torneo')) !== '')
            <tbody>
                @foreach ($search_inscrito as $inscrito)
                <tr>
                    <td>{{$inscrito->id_torneo}}</td>
                    <td>{{$inscrito->name}}</td>
                </tr>
                @endforeach
        @endif
            </tbody>
    </table>
</body>
</html>