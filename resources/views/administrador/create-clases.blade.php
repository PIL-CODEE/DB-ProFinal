<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{asset('css/register-class.css')}}">
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
    <form method="POST" action="{{route('administrador.create-class')}}">
        <h2>REGÍSTRAR NUEVA CLASE</h2>
        @csrf
        <div class="row">
            <div class="input-gruop">
                <label for="categoriaInput">Categoria: </label>
                <select name="categoria" id="categoriaInput">
                    <option value=""> - </option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
                </select>
            </div>
            <div class="input-gruop">
                <label for="instructorInput">Instructor: </label>
                <input type="text" id="instructorInput" name="instructor" required>
            </div>
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="cupos-totalesInput">Cupos Totales: </label>
                <input type="number" id="cupos-totalesInput" name="cupos_totales" required autocomplete="disable">
            </div>
            <div class="input-gruop">
                <label for="duracionInput">Duración: </label>
                <input type="text" id="duracionInput" name="duracion" required autocomplete="disable">
            </div>
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="fecha-inicioInput">Fecha de inicio: </label>
                <input type="date" id="fecha-inicioInput" name="fecha_inicio" required autocomplete="disable">
            </div>
            <div class="input-gruop">
                <label for="hora-inicioInput">Hora de inicio: </label>
                <input type="time" id="hora-inicioInput" name="hora_inicio" required autocomplete="disable">
            </div>  
        </div>
        <div class="row">
            <div class="input-gruop">
                <label for="hora-finInput">Hora de fin: </label>
                <input type="time" id="hora-finInput" name="hora_fin" required autocomplete="disable">
            </div>
            <div class="input-gruop">
                <label for="inscripcionInput">Costo de inscripción: </label>
                <input type="number" id="inscripcionInput" name="costo_inscripcion" required autocomplete="disable">
            </div>
        </div>
        <div>
            <label for="descripcionInput">Información resumida de la clase: </label>
            <textarea name="descripcion" id="descripcionInput"></textarea>
        </div>
        <button type="submit"><b>REGISTRAR</b></button>
    </form>
</body>
</html>