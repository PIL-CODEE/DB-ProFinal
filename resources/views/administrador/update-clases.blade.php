<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/register-class.css')}}">
    <title>Clases de Tenis</title>
</head>
<body>
    <header>
        <nav>
            <ul class="ul1">
                <li><a>Inicio</a></li>
            </ul>
            <img src="{{asset('img/Logo Olympues Tennis Camp.jpg')}}" alt="">
            <ul class="ul2">
                <li><a href="{{route('administrador.clases')}}">Atras</a></li>
            </ul>
        </nav>
    </header>
    @foreach ($clases as $clase)
    <form method="POST" action="{{route('administrador.update-class', $clase->id)}}">
    <h2>MODIFICAR CLASE</h2>
        @csrf
        <div class="row">
            <div class="input-gruop">
                <label for="idInput">ID: </label>
                <input type="text" value="{{$clase->id}}" readonly>
            </div>
            <div class="input-gruop">
                <label for="categoriaInput">Categoria: </label>
                <select name="categoria" id="categoriaInput">
                    <option value=""> - </option>
                    @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="instructorInput">Instructor: </label>
                <input type="text" id="instructorInput" name="instructor" required value="{{$clase->instructor}}">
            </div>
            <div class="input-gruop">
                <label for="cupos-totalesInput">Cupos Totales: </label>
                <input type="number" id="cupos-totalesInput" name="cupos_totales" required value="{{$clase->cupos_totales}}">
            </div>
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="duracionInput">Duración: </label>
                <input type="text" id="duracionInput" name="duracion" required value="{{$clase->duracion}}">
            </div>
            <div class="input-gruop">
                <label for="fecha-inicioInput">Fecha de inicio: </label>
                <input type="date" id="fecha-inicioInput" name="fecha_inicio" required value="{{$clase->fecha_inicio}}">
            </div>
        </div>
        <div class="row">
            <div class="input-gruop2">
                <label for="hora-inicioInput">Hora de inicio: </label>
                <input type="time" id="hora-inicioInput" name="hora_inicio" required value="{{$clase->hora_inicio}}">
            </div>
            <div class="input-gruop2">
                <label for="hora-finInput">Hora de fin: </label>
                <input type="time" id="hora-finInput" name="hora_fin" required value="{{$clase->hora_fin}}">
            </div>
            <div class="input-gruop2">
                <label for="inscripcionInput">Costo de inscripción: </label>
                <input type="number" id="inscripcionInput" name="costo_inscripcion" required value="{{$clase->costo_inscripcion}}">
            </div>
        </div>
        <div>
            <label for="descripcionInput">Información resumida de la clase: </label>
            <textarea name="descripcion" id="descripcionInput" required >{{$clase->descripcion}}</textarea>
        </div>
        <button type="submit"><b>GUARDAR</b></button>
    </form>
    @endforeach
</body>
</html>