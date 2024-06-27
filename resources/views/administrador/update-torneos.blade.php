<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/register-class.css')}}">
    <title>Modificar torneo</title>
</head>
<body>
    <header>
        <nav>
            <ul class="ul1">
                <li><a>Inicio</a></li>
            </ul>
            <img src="{{asset('img/Logo Olympues Tennis Camp.jpg')}}" alt="">
            <ul class="ul2">
                <li><a href="{{route('administrador.torneos')}}">Atras</a></li>
            </ul>
        </nav>
    </header>
    @foreach ($torneos as $torneo)
    <form method="POST" action="{{route('administrador.update-torneo', $torneo->id)}}">
    <h2>MODIFICAR CLASE</h2>
        @csrf
        <div class="row">
            <div class="input-gruop">
                <label for="idInput">ID: </label>
                <input type="text" value="{{$torneo->id}}" readonly>
            </div>
            <div class="input-gruop">
                <label for="categoriaInput">Categoria: </label>
                <select name="categoria" id="categoriaInput">
                    <option value="{{$torneo->id_categoria}}">Nueva categoria</option>
                    @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="organizadorInput">Organizador: </label>
                <input type="text" id="organizadorInput" name="organizador" required value="{{$torneo->organizador}}">
            </div>
            <div class="input-gruop">
                <label for="nombre_torneoInput">Nombre del Torneo: </label>
                <input type="text" id="nombre_torneoInput" name="nombre_torneo" required value="{{$torneo->nombre_torneo}}">
            </div>
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="modalidadInput">Modalidad: </label>
                <input type="text" id="modalidadInput" name="modalidad" required value="{{$torneo->modalidad}}">
            </div>
            <div class="input-gruop">
                <label for="cupos-totalesInput">Cupos Totales: </label>
                <input type="number" id="cupos-totalesInput" name="cupos_totales" required value="{{$torneo->cupos_totales}}">
            </div>
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="fecha-inicioInput">Fecha de inicio: </label>
                <input type="date" id="fecha-inicioInput" name="fecha_inicio" required value="{{$torneo->fecha_inicio}}">
            </div>
            <div class="input-gruop2">
                <label for="hora-inicioInput">Hora de inicio: </label>
                <input type="time" id="hora-inicioInput" name="hora_inicio" required value="{{$torneo->hora_inicio}}">
            </div>
            <div class="input-gruop2">
                <label for="inscripcionInput">Costo de inscripción: </label>
                <input type="number" id="inscripcionInput" name="costo_inscripcion" required value="{{$torneo->costo_inscripcion}}">
            </div>
        </div>
        <div>
            <label for="descripcionInput">Información resumida de la torneo: </label>
            <textarea name="descripcion" id="descripcionInput" >{{$torneo->descripcion}}</textarea>
        </div>
        <button type="submit"><b>GUARDAR</b></button>
    </form>
    @endforeach
</body>
</html>