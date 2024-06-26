<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/index-usuario.css')}}">
    <title>Document</title>
    <style>
        .conteiner_one {
            background-image: url("{{ asset('img/Index.jpeg') }}");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .conteiner_three {
            background-image: url("{{ asset('img/Torneos 3.jpeg') }}");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .conteiner_five {
            background-image: url("{{ asset('img/Canchas.png') }}");
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
    <div class="conteiner_one">
        <h1 class="title_conteiner_one">OLYMPUS</h1>
        <h1 class="title_conteiner_onee">TENNIS CAMP</h1>
        <div class="row">
            <div class="input-gruop"> 
                <a href="" class="a_conteniner_one"><b>Reservar una chanca</b></a>
            </div>
            <div class="input-gruop">
                <a href="" class="a_conteniner_one"><b>Inscribirme a una Academia grupal</b></a>
            </div>
            <div class="input-gruop">
                <a href="" class="a_conteniner_one"><b>Participar en un Torneo</b></a>
            </div>
        </div>
    </div>
    <div class="conteiner_two roww">
        <div class="input-gruopp">
            <p class="p_conteiner_two">________________________________</p>
            <h2 class="title_conteiner_two">Acerca de nosotros</h2>
            <p class="p_conteiner_two">En nuestra empresa, nos apasiona brindar a nuestros clientes la oportunidad de disfrutar 
                del tenis en su máxima expresión. Nos enorgullece ofrecer instalaciones de primera calidad 
                y un servicio excepcional para garantizar que cada visita a nuestras canchas sea una 
                experiencia inolvidable. Ya sea que seas un jugador experimentado o estés dando tus primeros 
                pasos en este apasionante deporte, estamos aquí para proporcionarte un espacio donde puedas 
                desarrollar tu pasión por el tenis y crear recuerdos duraderos. ¡Únete a nosotros y descubre 
                todo lo que nuestro centro de alquiler de canchas tiene para ofrecer!"</p>
        </div>
        <div class="input-gruopp">
            <img src="{{ asset('img/Ubicación.jpg') }}" class="img_conteiner_two">
        </div>
    </div>
    <div class="conteiner_three roww">
            <div class="input-gruopp">
                <img src="{{ asset('img/Competidor 2.jpg') }}" class="img_conteiner_two">
            </div>
            <div class="input-gruopp">
                <p class="p_conteiner_three">______________</p>
                <h2 class="title_conteiner_three">Torneos</h2>
                <p class="p_conteiner_three">En Olympus Tennis Camp nos enorgullece ofrecer una variedad de torneos 
                    emocionantes diseñados para jugadores de todos los niveles. Participa en 
                    competencias amistosas, mejora tus habilidades y disfruta de la emoción del 
                    juego en un entorno competitivo y amigable.</p>
                <a href="" class="a_conteniner_three"><b>Participar en un Torneo</b></a>
            </div>
    </div>
    <div class="conteiner_four roww">
            <div class="input-gruopp">
                <p class="p_conteiner_four">_____________________________</p>
                <h2 class="title_conteiner_two">Canchas de Tenis</h2>
                <p class="p_conteiner_four">Nos enorgullece ofrecer a nuestros clientes cinco canchas de tenis 
                    de primera calidad, diseñadas para proporcionar la mejor experiencia de juego posible. 
                    Cada una de nuestras canchas está equipada con las más modernas instalaciones, asegurando 
                    un entorno seguro y cómodo para todos los jugadores. ¡No esperes más! Reserva ahora una de 
                    nuestras canchas y disfruta de una partida de tenis en las mejores condiciones posibles.</p>
                <a href="" class="a_conteniner_three"><b>Reservar una cancha ¡AHORA!</b></a>
            </div>
            <div class="input-gruopp">
                <img src="{{ asset('img/Canchas de tenis.jpeg') }}" class="img_conteiner_four">
            </div>
    </div>
    <div class="conteiner_five roww">
            <div class="input-gruopp">
                <img src="{{ asset('img/Alumnos.jpeg') }}" class="img_conteiner_five">
            </div>
            <div class="input-gruopp">
                <p class="p_conteiner_three">________________________________</p>
                <h2 class="title_conteiner_five">Academias grupales</h2>
                <p class="p_conteiner_five">Descubre el placer de aprender y mejorar tu juego con nuestras
                     clases de tenis. Ofrecemos programas personalizados para todas las edades y niveles de
                      habilidad, impartidos por entrenadores profesionales con amplia experiencia. 
                      Ya sea que estés comenzando desde cero o buscando perfeccionar tus técnicas, nuestras 
                      clases te proporcionarán las herramientas y el apoyo necesarios para alcanzar tus objetivos.</p>
                <a href="" class="a_conteniner_five"><b>Inscribirme a una Academia grupal</b></a>
            </div>
    </div>
    <div class="conteiner_six roww">
            <div class="input-gruopp">
                <img src="{{ asset('img/Logo_2.png') }}" class="img_conteiner_six">
            </div>
            <div class="input-gruopp">
                <h2 class="title_conteiner_six">Ubicanos</h2>
                <p class="p_conteiner_six">Av. Dolores 125, José Luis Bustamante y Rivero 04002</p>
            </div>
            <div class="input-gruopp">
                <h2 class="title_conteiner_six">Redes</h2>
                <p class="p_conteiner_six" >Facebook - Instagram</p>
            </div>
            <div class="input-gruopp">
                <p class="p_conteiner_five"></p>
                <a href="" class="a_conteniner_six"><b>Contactanos</b></a>
            </div>
    </div>
</body>
</html> 