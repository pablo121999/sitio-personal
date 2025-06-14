@include('layouts.header')

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


        <!-- Contenido del perfil -->
        <div class="d-flex flex-wrap align-items-center justify-content-center text-center text-md-start"
            style="margin-top: 70px;">
            <div class="me-md-5 mb-4 mb-md-0">
                <img src="{{ asset('img/FotoPerfil.jpg') }}" alt="Pablo" class="profile-img rounded-circle shadow"
                    style="width: 336px; height: 336px; object-fit: cover; border: 10px solid white;" />
            </div>
            <div style="max-width: 500px">
                <h2 class="fw-bold mb-2">Pablo Andres Aroca Garcia</h2>
                <p class="text-muted mb-1"><strong>Ingeniero de sistemas</strong></p>
                <p class="text-muted">
                    Cuento con sólidos conocimientos y experiencia en desarrollo de software, así como habilidades para
                    diseñar, analizar, integrar y gestionar sistemas de información alineados con las necesidades de las
                    organizaciones.
                    Actualmente, centro mi carrera en el desarrollo web, especializándome en tecnologías como PHP
                    (Laravel), JavaScript, HTML, CSS y MySQL. Me apasiona crear soluciones funcionales, escalables y
                    eficientes. Estoy en constante aprendizaje, con el objetivo de fortalecer mis competencias y aportar
                    valor en cada proyecto en el que participo.
                </p>
                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start mt-4">
                    <a href="{{ asset('pdf/hoja de vida 2025.pdf') }}" download class="btn btn-outline-primary">Download
                        CV</a>

                    <div class="mt-3">
                        <a href="mailto:pabloaroca78@gmail.com" class="me-3 text-danger text-decoration-none"
                            title="Enviar correo a Pablo Andrés" aria-label="Correo">
                            <i class="fab fa-google fa-lg"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/pabloaroca/" class="me-3 text-primary text-decoration-none"
                            title="Perfil de LinkedIn" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in fa-lg"></i>
                        </a>
                        <a href="https://github.com/pablo121999" class="me-3 text-dark text-decoration-none"
                            title="Perfil de GitHub" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                            <i class="fab fa-github fa-lg"></i>
                        </a>
                        <a href="https://wa.me/573227893926" class="text-success text-decoration-none"
                            title="Chatear por WhatsApp" target="_blank" rel="noopener noreferrer"
                            aria-label="WhatsApp">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>


        <div style="margin-top: 100px;">
            <h2 class="text-center" style="margin-bottom: 30px;"><strong>Mi línea de tiempo</strong></h2>
            @include('LineaTiempo.Timeline')
        </div>


        <div class="row" style="margin-top: 40px;">

            <div class="col-md-9">
                <h5 class="text-center" style="margin-bottom: 30px;"><strong>Estudios</strong></h5>
                @include('estudios.main')
            </div>

            <div class="col-md-3">
                <h5 class="text-center" style="margin-bottom: 30px;"><strong>Skills</strong></h5>
                <div class="card" style="border-radius: 20px; background-color: #f2f2f2;">
                    <div class="card-body">
                        <ul>
                            <li>PHP <i class="fa-brands fa-php "></i> (<i class="fab fa-laravel"></i>)</li>
                            <li>JavaScript <i class="fa-brands fa-js "></i></li>
                            <li>CSS <i class="fab fa-css3 "></i></li>
                            <li>HTML <i class="fab fa-html5 "></i></li>
                            <li>MySQL <i class="fa-solid fa-database "></i></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>


        <div style="margin-top: 50px;">
            <h5 class="text-center" style="margin-bottom: 30px;"><strong>Experiencia</strong></h5>
            @include('experiencia.main')
        </div>

        <div style="margin-top: 50px;">
            <h5 class="text-center" style="margin-bottom: 30px;"><strong>Juegos</strong></h5>
            @include('juegos.main')
        </div>


    </div>

</body>

@if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
@endif

@include('layouts.footer')
