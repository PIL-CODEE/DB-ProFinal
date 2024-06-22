<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases de Tenis</title>
</head>
<body>
    <header>
        <a href="{{route('administrador.register-class')}}"><b>Registrar clase de tenis</b></a>
        <a href="{{route('administrador.edit-class')}}"><b>Modificar clase de tenis</b></a>

    </header>
    <h2>Clases ACTIVAS</h2>
    <table>
        <thead>
            <tr>
                <th>ID CLASE</th>
                <th>CATEGORIA</th>
                <th>INSTRUCTOR</th>
                <th>CUPOS TOTALES</th>
                <th>CUPOS DISPONIBLES</th>
                <th>DURACIÓN</th>
                <th>FECHA DE INICIO</th>
                <th>HORA DE INICIO</th>
                <th>HORA FIN</th>
                <th>CONSTO DE INSCRIPCIÓN</th>
                <th>ESTADO</th>
                <th></th>
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
                <td>{{$clase->costo_inscripcion}}</td>
                <td>{{$clase->estado}}</td>
                <td>
                    <a href="{{route('administrador.desactivar-estado', $clase->id)}}"><button>Desactivar</button></a>
                </td>
                <td>
                    <a href="{{route('administrador.delete-classes', $clase->id)}}"><button>Eliminar</button></a>
                </td>
                <td>
                    <a href="{{route('administrador.edit-class', $clase->id)}}"><button>Editar</button></a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <h2>Clases TERMINADAS</h2>
    <table>
        <thead>
            <tr>
                <th>ID CLASE</th>
                <th>CATEGORIA</th>
                <th>INSTRUCTOR</th>
                <th>CUPOS TOTALES</th>
                <th>CUPOS DISPONIBLES</th>
                <th>DURACIÓN</th>
                <th>FECHA DE INICIO</th>
                <th>HORA DE INICIO</th>
                <th>HORA FIN</th>
                <th>CONSTO DE INSCRIPCIÓN</th>
                <th>ESTADO</th>
                <th></th>
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
                <td>{{$clase->costo_inscripcion}}</td>
                <td>{{$clase->estado}}</td>
                <td>
                    <a href="{{route('administrador.activar-estado', $clase->id)}}"><button>Activar</button></a>
                </td>
                <td>
                    <a href="{{route('administrador.delete-classes', $clase->id)}}"><button>Eliminar</button></a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>