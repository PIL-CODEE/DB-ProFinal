<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
</head>
<body>
    <form method="POST" action="{{route('administrador.create-class')}}">
        <h2>REGÍSTRAR NUEVA CLASE</h2>
        @csrf
        <label for="categoriaInput">Categoria: </label>
        <select name="categoria" id="categoriaInput">
            <option value=""> - </option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
        @endforeach
        </select>
        <label for="instructorInput">Instructor: </label>
        <input type="text" id="instructorInput" name="instructor" required>
        <label for="cupos-totalesInput">Cupos Totales: </label>
        <input type="number" id="cupos-totalesInput" name="cupos_totales" required autocomplete="disable">
        <label for="duracionInput">Duración: </label>
        <input type="text" id="duracionInput" name="duracion" required autocomplete="disable">
        <label for="fecha-inicioInput">Fecha de inicio: </label>
        <input type="date" id="fecha-inicioInput" name="fecha_inicio" required autocomplete="disable">
        <label for="hora-inicioInput">Hora de inicio: </label>
        <input type="time" id="hora-inicioInput" name="hora_inicio" required autocomplete="disable">
        <label for="hora-finInput">Hora de fin: </label>
        <input type="time" id="hora-finInput" name="hora_fin" required autocomplete="disable">
        <label for="inscripcionInput">Costo de inscripción: </label>
        <input type="number" id="inscripcionInput" name="costo_inscripcion" required autocomplete="disable">
        <button type="submit"><b>REGISTRAR</b></button>
    </form>
</body>
</html>