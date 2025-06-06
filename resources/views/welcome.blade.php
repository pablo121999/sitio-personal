@include('layouts.header')


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid col-md-10">
        <a class="navbar-brand fw-bold text-primary" href="#">¡Hola! Bienvenidos</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            </ul>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary ms-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary ms-2">Inicia sesión</a>

                    @if (Route::has('register'))
                        <!--     <a href="{{ route('register') }}" class="btn btn-success ms-2">Crear cuenta</a> -->
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>


<div class="container-fluid col-md-10" style="margin-top: 40px;">


    <div class="row">

        <div class="col-md-9">
            <div class="card" style="border-radius: 20px; background-color: #f2f2f2;">
                <div class="card-body">
                    <h5 class="card-title"><strong>¡Hola! Soy Pablo Andrés Aroca García</strong></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Ingeniero de Sistemas</h6>
                    <p class="card-text">
                        Soy Ingeniero de Sistemas especializado en desarrollo web. Me apasiona la programación y
                        disfruto crear soluciones eficientes y funcionales. Cuento con experiencia en tecnologías como
                        PHP, JavaScript, MySQL, CSS, HTML
                        Siempre estoy en constante aprendizaje para mantenerme actualizado y aportar valor en cada
                        proyecto.
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

                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card" style="border-radius: 20px; background-color: #f2f2f2;">
                <div class="card-body">
                    <h5 class="card-title  text-center"><strong>Skills</strong></h5>
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
        <h4 class="text-center" style="margin-bottom: 30px;"><strong>Mi línea de tiempo</strong></h4>
        @include('LineaTiempo.Timeline')
    </div>


    <div style="margin-top: 50px;">
        <h4 class="text-center" style="margin-bottom: 30px;"><strong>Estudios</strong></h4>
        @include('estudios.main')
    </div>


    <div style="margin-top: 50px;">
        <h4 class="text-center" style="margin-bottom: 30px;"><strong>Experiencia</strong></h4>
        @include('experiencia.main')
    </div>

     <div style="margin-top: 50px;">
        <h4 class="text-center" style="margin-bottom: 30px;"><strong>Juegos</strong></h4>
        @include('juegos.main')
    </div>


</div>

@if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
@endif

@include('layouts.footer')
