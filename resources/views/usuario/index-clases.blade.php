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
                <li><a href="{{route('usuario.index-torneos')}}">Torneos</a></li>
            </ul>
            <img src="{{asset('img/Logo Olympues Tennis Camp.jpg')}}" alt="">
            <ul class="nav2">
                <li><a href="">Ubicación</a></li>
                @if (Auth::check())
                    <li><a href="#">Cuenta de {{Auth::user()->name}}</a></li>
                    <li><a href="{{route('logout')}}">Salir</a></li>
                @else 
                    <li><a href="{{route('login')}}">Iniciar Sesión</a></li>
                    <li><a href="{{route('registro')}}">Registrate</a></li>
                @endif
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
                <td>
                    <button class="hero_cta" data-clase-info="{{ json_encode($clase) }}" data-fecha_inicio="{{ $clase->fecha_inicio }}" 
                    data-hora_inicio="{{ $clase->hora_inicio }}" data-hora_fin="{{ $clase->hora_fin }}" data-costo_inscripcion="{{ $clase->costo_inscripcion }}"
                    data-descripcion="{{ $clase->descripcion }}">
                        <b>Más Información</b>
                    </button>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <section class="modal">
        <div class="modal_container">
            <h2 class="modal_title">INFORMACIÓN DE LA CLASE</h2>
            <p id="descripcion" class="modal_paragraph"></p>
            <p id="fecha_inicio" class="modal_paragraph"></p>
            <p id="hora_inicio" class="modal_paragraph"></p>
            <p id="hora_fin" class="modal_paragraph"></p>
            <p id="costo_inscripcion" class="modal_paragraph"></p>
            <a id="inscribirseLink" class="inscribirse"><b>Inscribirme</b></a>
            <a class="modal_close"><b>Cancelar</b></a>
        </div>
    </section>
    <script>
        const openModalButtons = document.querySelectorAll('.hero_cta');
        const modal = document.querySelector('.modal');
        const inscribirseLink = document.getElementById('inscribirseLink');
        const closeModal = document.querySelector('.modal_close');
        const fecha_inicioParagraph = document.getElementById('fecha_inicio');
        const hora_inicioParagraph = document.getElementById('hora_inicio');
        const hora_finParagraph = document.getElementById('hora_fin');
        const costo_inscripcionParagraph = document.getElementById('costo_inscripcion');
        const descripcionParagraph = document.getElementById('descripcion');

        openModalButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const claseInfo = JSON.parse(button.dataset.claseInfo);
                const descripcion = button.dataset.descripcion;
                const fecha_inicio = button.dataset.fecha_inicio;
                const hora_inicio = button.dataset.hora_inicio;
                const hora_fin = button.dataset.hora_fin;
                const costo_inscripcion = button.dataset.costo_inscripcion;

                inscribirseLink.href = `{{ route('usuario.inscribirse', '') }}/${claseInfo.id}`;
                descripcionParagraph.textContent = `${descripcion}`;
                fecha_inicioParagraph.textContent = `Fecha de inicio: ${fecha_inicio}`;
                hora_inicioParagraph.textContent = `Hora de inicio: ${hora_inicio}`;
                hora_finParagraph.textContent = `Hora de culminación: ${hora_fin}`;
                costo_inscripcionParagraph.textContent = `Costo de inscripción: S/ ${costo_inscripcion}`;
                modal.classList.add('modal_show');
            });
        });

        closeModal.addEventListener('click', (e)=> {
            e.preventDefault();
            modal.classList.remove('modal_show');
        });
    </script>
</body>
</html>