@include('layouts.header')
<link rel="stylesheet" href="{{ asset('css/simuladorAvion.css') }}">
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

<body>
    <div class="profile-card shadow-lg bg-white p-4">
        <!-- NAVBAR dentro de la card -->
        <nav class="navbar navbar-expand-lg  mb-4">

            <div class="container-fluid">
                <!-- Logo y nombre -->
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px">
                        <strong>P</strong>
                    </div>
                    <span class="ms-2 fw-bold text-dark">Pablo Andres</span>
                </a>

                <!-- Botón toggle para pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-list text-primary fs-2"></i>
                </button>

                <!-- Contenido colapsable -->
                <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-secondary fw-semibold" href="#">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary fw-semibold" href="#">Resume</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary fw-semibold" href="#">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary fw-semibold" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary ms-2">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary ms-2">Inicia sesión</a>

                                    @if (Route::has('register'))
                                        <!-- <a href="{{ route('register') }}" class="btn btn-success ms-2">Crear cuenta</a> -->
                                    @endif
                                @endauth
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid " style="margin-top: 40px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('simuladorAvion') }}">Simulador de avión</a>
                </li>
                @yield('breadcrumb')
            </ol>
        </div>

        <h4 class="text-center" style="margin-top: 30px; margin-bottom: 20px;">
            <strong>Simulador de avión</strong>
        </h4>


        <div id="simulator">
            <div id="hud">
                <div class="indicator">Velocidad: <span id="speed">0</span> km/h</div>
                <div class="indicator">Altitud: <span id="altitude">0</span> m</div>
                <div class="indicator">Dirección: <span id="direction">0</span>°</div>
            </div>
            <div id="horizon">
                <div id="sky"></div>
                <div id="ground"></div>
                <div id="contenerplane">
                    <img id="nube1" src="{{ asset('img/nube.png') }}" height="50px" width="150px" />

                    <img id="nube2" src="{{ asset('img/nube.png') }}" height="50px" width="150px" />

                    <img id="nube3" src="{{ asset('img/nube.png') }}" height="50px" width="150px" />

                    <img id="nube4" src="{{ asset('img/nube.png') }}" height="50px" width="150px" />

                    <img id="nube5" src="{{ asset('img/nube.png') }}" height="50px" width="150px" />

                    <img id="plane" src="{{ asset('img/avionsimulador.png') }}" style="center;" height="70px"
                        width="150px" />
                </div>

                <audio id="audioPlayer" controls autoplay loop>
                    <source src="{{ asset('audio/avion.mp3') }}" type="audio/mpeg">
                    Tu navegador no soporta la reproducción de audio.
                </audio>

            </div>
            <div id="instructions">
                Usa las flechas para controlar el avión:
                <ul>
                    <li>Arriba: Subir</li>
                    <li>Abajo: Bajar</li>
                    <li>Izquierda: Girar a la izquierda</li>
                    <li>Derecha: Girar a la derecha</li>
                    <li>Espacio: Velocidad</li>
                </ul>
            </div>
        </div>

    </div>
</body>


<script src="{{ asset('js/simuladorAvion.js') }}"></script>
@include('layouts.footer')
