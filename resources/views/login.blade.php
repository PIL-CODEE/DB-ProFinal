<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <form method="POST" action="{{route('start-sesion')}}">
        <h2>INICIAR SESIÓN</h2>
        @csrf
        <label for="emailInput">Email: </label>
        <input type="email" id="emailInput" name="email" required autocomplete="disable">
        <label for="passwordInput">Contraseña: </label>
        <input type="password" id="passwordInput" name="password" required>
        <p>¿No tienes cuenta? <a href="{{route('registro')}}">Registrate...</a></p>
        <button type="submit"><b>Acceder</b></button>
    </form>
</body>
</html>