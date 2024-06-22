<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases de Tenis</title>
</head>
<body>
    <header>
        <a href="{{route('administrador.clases')}}"><b>Atras</b></a>
    </header>
    <h2>Modificar clase</h2>
    @foreach ($clases as $clase)
    <form method="POST" action="{{route('administrador.update-class', $clase->id)}}">
        @csrf
        <label for="idInput">ID: </label>
        <input type="text" value="{{$clase->id}}" readonly>

        <label for="categoriaInput">Categoria: </label>
        <select name="categoria" id="categoriaInput">
            <option value=""> - </option>
            @foreach ($categorias as $categoria)
            <option value="{{$categoria->id}}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        
        <label for="instructorInput">Instructor: </label>
        <input type="text" id="instructorInput" name="instructor" required value="{{$clase->instructor}}">

        <label for="cupos-totalesInput">Cupos Totales: </label>
        <input type="number" id="cupos-totalesInput" name="cupos_totales" required value="{{$clase->cupos_totales}}">

        <label for="duracionInput">Duración: </label>
        <input type="text" id="duracionInput" name="duracion" required value="{{$clase->duracion}}">

        <label for="fecha-inicioInput">Fecha de inicio: </label>
        <input type="date" id="fecha-inicioInput" name="fecha_inicio" required value="{{$clase->fecha_inicio}}">

        <label for="hora-inicioInput">Hora de inicio: </label>
        <input type="time" id="hora-inicioInput" name="hora_inicio" required value="{{$clase->hora_inicio}}">

        <label for="hora-finInput">Hora de fin: </label>
        <input type="time" id="hora-finInput" name="hora_fin" required value="{{$clase->hora_fin}}">

        <label for="inscripcionInput">Costo de inscripción: </label>
        <input type="number" id="inscripcionInput" name="costo_inscripcion" required value="{{$clase->costo_inscripcion}}">
        
        <button type="submit"><b>GUARDAR</b></button>
    </form>
    @endforeach
</body>
</html>