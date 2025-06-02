<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<style>
    .footer {
        background-color: #f2f2f2;
        padding: 30px 0;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        margin: 0 10px;
        border-radius: 50%;
        color: white;
        font-size: 20px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .social-icon.google {
        background-color: #dd4b39;
    }

    .social-icon.linkedin {
        background-color: #0082ca;
    }

    .social-icon.github {
        background-color: #333;
    }

    .social-icon.whatsapp {
        background-color: #0ef40e;
    }
</style>

<!-- Footer -->
<footer class="footer text-center" style="margin-top: 20px;">
    <div class="container mb-3">
        <a href="mailto:pabloaroca78@gmail.com" class="social-icon google"><i class="fab fa-google"></i></a>
        <a href="https://www.linkedin.com/in/pabloaroca/" class="social-icon linkedin" target="_blank"><i
                class="fab fa-linkedin-in"></i></a>
        <a href="https://github.com/pablo121999" class="social-icon github" target="_blank"><i
                class="fab fa-github"></i></a>
        <a href="https://wa.me/573227893926" class="social-icon whatsapp" target="_blank" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    @php
        $protocolo = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'];
        $url = $protocolo . $host . $uri;
    @endphp
    <div>
        © 2025 Copyright:
        <a class="text-decoration-none fw-bold" href=" {{ $url }} "> {{ $url }}</a>
    </div>
</footer>