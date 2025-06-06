@include('layouts.header')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid col-md-10">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">¡Hola! Bienvenidos</a>

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
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}">Inicio</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('PersonalizaAvion') }}">Personaliza tu avión</a>
        </li>
        @yield('breadcrumb')
    </ol>
</div>


<h4 class="text-center" style="margin-top: 30px; margin-bottom: 50px;">
    <strong>Personaliza tu avión</strong>
</h4>


<style>
    .center {
        position: absolute;
        top: 50%;
        left: 45%;
        transform: translate(-50%, -50%);
    }
</style>


<div class="center" style="margin-top: 70px;">


    <link rel="stylesheet" href="{{ asset('css/personalizaAvion.css') }}">
    <script src="{{ asset('js/personalizaAvion.js') }}"></script>


    <div class="form-group row">
        <div class="col-sm-2">
            <label for="nombreCompleto" class="col-form-label"><b>Nombre:</b></label>
        </div>
        <div class="col-sm-5" style="margin-bottom: 20px;">
            <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto"
                placeholder="Ingrese su nombre">
        </div>

    </div>

    <!-- SVG para dibujar -->
    <div id="svg-container">
    </div>

    <!-- Selector de Colores y Herramientas -->

    <div class="tool-picker">
        <button class="brush-icon" title="Color">🎨</button>
        <div class="color-picker">
            <button style="background-color: red;" data-color="red"></button>
            <button style="background-color: blue;" data-color="blue"></button>
            <button style="background-color: green;" data-color="green"></button>
            <button style="background-color: yellow;" data-color="yellow"></button>
            <button style="background-color: purple;" data-color="purple"></button>
            <button style="background-color: black;" data-color="black"></button>
            <button style="background-color: gray;" data-color="gray"></button>
            <button style="background-color: pink;" data-color="pink"></button>
            <button style="background-color: lightblue;" data-color="lightblue"></button>
            <button style="background-color: #75AADB;" data-color="#75AADB"></button>
            <button style="background-color: #FFFFFF; border: 1px solid #ccc;" data-color="#FFFFFF"></button>
            <button style="background-color: #8B4513; color: white;" data-color="#8B4513"></button>
        </div>

        <div class="size-picker">
            <button id="tamanopincel" title="Tamaño de pincel" class="regla-icon">📏</button>
            <input id="brush-size" type="range" min="1" max="20" value="5">
        </div>
    </div>


    <div class="Borrador  form-group row">
        <input id="eraser-size" type="range" min="5" max="50" value="10">
    </div>

    <div class="buttonBorrador  form-group row">
        <button id="eraser" title="Borrador" class="borrador-icon">🧽</button> <!-- Icono de borrador -->
        <button id="tamanoBorrador" title="Tamaño de borrador" class="reglaBorrador-icon">📏</button>
    </div>



    <div class="elegir  form-group row">
        <div class="col-sm-9">
            <input type="hidden" id="airplane-selector">
            <!-- Contenedor de miniaturas -->
            <div id="thumbnail-container" style="display: flex; gap: 20px;"></div>
        </div>
    </div>


    <div class="controls3">
        <button onclick="imprimir()" class="impresora-icon">📷</button>
    </div>

    <div id="loader"
        style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; background:#fff; padding:20px; border:1px solid #ccc; z-index:9999;">
        <p id="progress-text">Generando imagen: 0%</p>
        <progress id="progress-bar" value="0" max="100" style="width: 100%;"></progress>
    </div>


</div>

@php
    $url = asset('img/');
    $baseUrl = $url;
@endphp
<!-- Incluye esto antes de tu JS personalizado -->


<script src="{{ asset('js/html2canvas.min.js') }}"></script>

<script>
    const svgContainer = document.getElementById('svg-container');
    const colorButtons = document.querySelectorAll('.color-picker button');
    const brushSizeInput = document.getElementById('brush-size');
    const eraserButton = document.getElementById('eraser');
    const eraserSizeInput = document.getElementById('eraser-size');
    const avionselecionado = document.getElementById('airplane-selector');
    const inputNombre = document.getElementById('nombreCompleto');

    let thumbnailContainer = document.getElementById('thumbnail-container');

    let baseUrl = @json($baseUrl);

    let currentAirplane = 'avion1';

    let brushColor = 'red';
    let brushSize = 5;
    let isEraser = false;
    let eraserSize = 10;


    // Generar miniaturas
    for (let i = 1; i <= 5; i++) {
        let thumb = document.createElement('img');
        thumb.src = `${baseUrl}/avion${i}.svg`;
        console.log(`${baseUrl}/avion${i}.svg`);

        thumb.alt = `Avión ${i}`;
        thumb.style.width = "120px";
        thumb.style.height = "60px";
        thumb.style.cursor = "pointer";
        thumb.style.boxShadow = "0 0 2px black";
        thumb.style.borderRadius = '10px';
        thumb.addEventListener("click", function() {
            updateImage(i);
            highlightThumbnail(i);
        });
        thumbnailContainer.appendChild(thumb);
    }


    document.addEventListener("DOMContentLoaded", function() {
        // Establecer la imagen 1 como predeterminada
        avionselecionado.value = "1"; // Asegurar que el selector tenga el valor correcto
        updateImage(1);
        loadAirplaneSVG();
        highlightThumbnail(1);

        // Función para actualizar el avión seleccionado
        function updateCurrentAirplane(value) {
            currentAirplane = `avion${value}`;
        }

        function updateImage(selectedValue) {
            currentAirplane = `avion${selectedValue}`;
            //  let imageUrl = `${baseUrl}${currentAirplane}.svg`;
            let imageUrl = `${baseUrl}/${currentAirplane}.svg`;

            //  console.log(`url = ${imageUrl}`);


            // Cargar el SVG correctamente en el contenedor
            loadAirplaneSVG();

            console.log(selectedValue);


            // Marcar la miniatura seleccionada
            highlightThumbnail(selectedValue);
        }

        // Asegurar que loadAirplaneSVG se llame después de cambiar el avión
        avionselecionado.addEventListener('change', function() {
            updateImage(this.value);
        });



        // Resalta la miniatura seleccionada
        function highlightThumbnail(selectedValue) {
            let thumbnails = thumbnailContainer.getElementsByTagName('img');
            for (let img of thumbnails) {
                img.style.border = "2px solid transparent";
            }
            thumbnails[selectedValue - 1].style.border = "2px solid blue";
        }

        // Manejar el cambio en el select
        avionselecionado.addEventListener('change', function() {
            updateImage(this.value);
            highlightThumbnail(this.value);
        });


        // Al hacer clic en una miniatura
        document.querySelectorAll('#thumbnail-container img').forEach((img, index) => {
            img.addEventListener("click", function() {
                updateImage(index + 1);
            });
        });

        // Cargar la imagen inicial correctamente
        document.addEventListener("DOMContentLoaded", function() {
            updateImage(avionselecionado.value);
        });

        // Cargar la imagen inicial
        updateImage(avionselecionado.value);
        highlightThumbnail(avionselecionado.value);

        // Cargar el archivo SVG con manejo de errores
        function loadAirplaneSVG() {
            const svgSrc = `${baseUrl}/${currentAirplane}.svg`;

            fetch(svgSrc)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(data => {
                    if (!data) {
                        throw new Error('SVG data is empty');
                    }
                    svgContainer.innerHTML = data;

                    const svg = svgContainer.querySelector('svg');
                    if (!svg) {
                        throw new Error('No SVG element found in response');
                    }


                    // Validar y establecer el atributo viewBox si no existe
                    let viewBox = svg.getAttribute('viewBox');
                    if (!viewBox) {
                        alert('El SVG no tiene un atributo viewBox definido.');
                        // Intentar crear un viewBox usando width y height
                        const width = parseFloat(svg.getAttribute('width')) || 500;
                        const height = parseFloat(svg.getAttribute('height')) || 500;
                        viewBox = `0 0 ${width} ${height}`;
                        svg.setAttribute('viewBox', viewBox);
                    }

                    // Obtener dimensiones del viewBox
                    const [minX, minY, viewBoxWidth, viewBoxHeight] = viewBox.split(' ').map(parseFloat);

                    // Ajustar el tamaño del contenedor al del SVG
                    svgContainer.style.width = `${viewBoxWidth}px`;
                    svgContainer.style.height = `${viewBoxHeight}px`;
                    svgContainer.style.border = '1px solid #ccc';
                    svgContainer.style.borderRadius = '20px';
                    // svgContainer.style.overflow = 'hidden';

                    svg.setAttribute('preserveAspectRatio', 'xMidYMid meet');
                    svg.style.border = '1px solid #ccc';
                    svg.style.position = 'relative';

                    // Crear un clipPath para limitar el área de dibujo
                    const defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
                    const clipPath = document.createElementNS('http://www.w3.org/2000/svg', 'clipPath');
                    clipPath.setAttribute('id', 'clip-path');

                    const airplaneShape = svg.querySelector('path'); // Supone que el avión es una <ruta>
                    if (airplaneShape) {
                        const cloneShape = airplaneShape.cloneNode(true);
                        clipPath.appendChild(cloneShape);
                        defs.appendChild(clipPath);
                        svg.insertBefore(defs, svg.firstChild);
                        svg.setAttribute('clip-path', 'url(#clip-path)');
                    }

                    enableDrawing(svg);


                    // Crear el label una sola vez al inicio
                    $(`#svg-container`).append(
                        `<div class="form-group row"> 
                        <label id="nombreCompletoLabel" class="col-sm-6 col-form-label text-left"><b>Autor: </b></label>
                        </div>
                        `
                    );

                    // Escuchar cambios en el input
                    inputNombre.addEventListener('input', function() {
                        var nombreCompleto = this.value; // Obtener el valor actual del input
                        // Actualizar el contenido del label existente
                        $('#nombreCompletoLabel').html(`<b>Autor: </b> ${nombreCompleto}`);
                    });


                })
                .catch(error => {
                    console.error('Error loading airplane SVG:', error);
                    svgContainer.innerHTML =
                        `<div style="padding: 20px; color: red;">Error al cargar el avión: ${error.message}</div>`;
                });
        }


        // Habilitar dibujo sobre el SVG
        function enableDrawing(svg) {
            let drawing = false;
            let lastX = null;
            let lastY = null;
            const svgPoint = svg.createSVGPoint();

            // Crear un grupo para los dibujos dinámicos
            let drawingGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            drawingGroup.setAttribute('id', 'drawing-group');
            drawingGroup.setAttribute('class', 'drawing-layer');
            svg.appendChild(drawingGroup);

            // Crear una máscara que coincida con las formas del SVG original
            const defs = svg.querySelector('defs') || document.createElementNS('http://www.w3.org/2000/svg',
                'defs');
            svg.insertBefore(defs, svg.firstChild);

            const mask = document.createElementNS('http://www.w3.org/2000/svg', 'mask');
            mask.setAttribute('id', 'drawing-mask');
            defs.appendChild(mask);

            // Clonar las formas originales del SVG para la máscara
            const originalShapes = Array.from(svg.querySelectorAll(
                'path, rect, circle, ellipse, polygon, polyline, line'));
            originalShapes.forEach(shape => {
                const clone = shape.cloneNode(true);
                clone.setAttribute('fill', 'white');
                mask.appendChild(clone);
            });

            // Aplicar la máscara al grupo de dibujo
            drawingGroup.setAttribute('mask', 'url(#drawing-mask)');

            function getSVGCoordinates(event) {
                svgPoint.x = event.clientX;
                svgPoint.y = event.clientY;
                return svgPoint.matrixTransform(svg.getScreenCTM().inverse());
            }

            function drawLine(x1, y1, x2, y2) {
                const distance = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
                const steps = Math.ceil(distance / brushSize);

                for (let i = 0; i <= steps; i++) {
                    const t = i / steps;
                    const x = x1 + (x2 - x1) * t;
                    const y = y1 + (y2 - y1) * t;

                    // Dibujar un círculo en el grupo de dibujo
                    const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                    circle.setAttribute('cx', x);
                    circle.setAttribute('cy', y);
                    circle.setAttribute('r', brushSize);
                    circle.setAttribute('fill', brushColor);
                    circle.setAttribute('stroke', 'none');
                    drawingGroup.appendChild(circle);
                }
            }


            svg.addEventListener('mousedown', (event) => {
                const point = getSVGCoordinates(event);
                // Dibujar un punto en el lugar del clic
                const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                circle.setAttribute('cx', point.x);
                circle.setAttribute('cy', point.y);
                circle.setAttribute('r', brushSize);
                circle.setAttribute('fill', brushColor);
                circle.setAttribute('stroke', 'none');
                drawingGroup.appendChild(circle);

                drawing = true;
                lastX = point.x;
                lastY = point.y;
            });


            svg.addEventListener('mousemove', (event) => {
                if (drawing && !isEraser) { // No permitir pintar si el borrador está activado
                    const point = getSVGCoordinates(event);
                    if (lastX !== null && lastY !== null) {
                        drawLine(lastX, lastY, point.x, point.y);
                    }
                    lastX = point.x;
                    lastY = point.y;
                }
            });

            document.addEventListener('mouseup', () => {
                drawing = false;
                lastX = null;
                lastY = null;
            });
        }


        // Cambiar color del pincel
        colorButtons.forEach(button => {
            button.addEventListener('click', () => {
                brushColor = button.getAttribute('data-color');
                isEraser = false;
            });
        });

        // Cambiar tamaño del pincel
        brushSizeInput.addEventListener('input', (event) => {
            brushSize = Math.max(1, parseInt(event.target.value) || 1);
            brushSizeInput.value = brushSize;
        });


        // Activar borrador para borrar en la zona clicada
        eraserButton.addEventListener('click', () => {
            isEraser = true; // Activar el modo borrador
        });

        // Función para borrar en la zona donde se hace clic
        function eraseDrawingAtPoint(svg, x, y, size) {
            const drawingGroup = document.getElementById('drawing-group');
            if (drawingGroup) {
                // Convertir las coordenadas del clic al espacio del SVG
                const svgPoint = svg.createSVGPoint();
                svgPoint.x = x;
                svgPoint.y = y;
                const point = svgPoint.matrixTransform(svg.getScreenCTM().inverse());

                // Encontrar los elementos cercanos a la posición de clic
                const elementsToRemove = Array.from(drawingGroup.children).filter(element => {
                    const cx = parseFloat(element.getAttribute('cx'));
                    const cy = parseFloat(element.getAttribute('cy'));
                    const radius = parseFloat(element.getAttribute('r')) || 0;
                    const distance = Math.sqrt(Math.pow(cx - point.x, 2) + Math.pow(cy - point.y, 2));
                    return distance <= (size +
                        radius); // Se borra si el círculo está dentro del área del borrador
                });

                // Eliminar los elementos seleccionados
                elementsToRemove.forEach(element => drawingGroup.removeChild(element));
            }
        }

        // Evento para eliminar color en la zona del SVG al hacer clic (cuando el borrador está activado)
        svgContainer.addEventListener('mousedown', (event) => {
            if (isEraser) {
                const svg = svgContainer.querySelector('svg');
                if (svg) {
                    eraseDrawingAtPoint(svg, event.clientX, event.clientY, eraserSize);
                }
            }
        });

        // Cambiar tamaño del borrador
        eraserSizeInput.addEventListener('input', (event) => {
            const value = Math.max(1, parseInt(event.target.value) || 1);
            eraserSize = value;
            eraserSizeInput.value = value; // Corregir en la interfaz
        });


        // Inicializar con la vista frontal y manejar cambios
        document.addEventListener('DOMContentLoaded', () => {
            // Establecer el avión inicial
            updateCurrentAirplane(avionselecionado.value);
            loadAirplaneSVG();

            // Evento para cambio de avión
            avionselecionado.addEventListener('change', (event) => {
                updateCurrentAirplane(event.target.value);
                loadAirplaneSVG();
            });

        });
    });




    function imprimir() {
        const original = document.getElementById("svg-container");

        // Mostrar loader
        const loader = document.getElementById("loader");
        const progressBar = document.getElementById("progress-bar");
        const progressText = document.getElementById("progress-text");
        loader.style.display = "block";

        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 10; // Incremento aleatorio
            if (progress > 98) progress = 98; // Simular carga sin llegar al 100%
            progressBar.value = progress;
            progressText.textContent = `Generando imagen: ${Math.floor(progress)}%`;
        }, 200);

        html2canvas(original, {
            useCORS: true,
            scale: 2,
            width: 700,
            height: 350,
            /* backgroundColor: null, */
        }).then(canvas => {
            clearInterval(interval); // Detener el progreso simulado
            progressBar.value = 100;
            progressText.textContent = "¡Imagen generada!";

            // Ocultar loader después de un pequeño retraso
            setTimeout(() => {
                loader.style.display = "none";
            }, 1000);

            const link = document.createElement("a");
            link.download = "imagen.png";
            link.href = canvas.toDataURL("image/png");
            link.click();
        }).catch(error => {
            clearInterval(interval);
            progressText.textContent = "Error al generar la imagen.";
            console.error("Error al generar la imagen:", error);
        });
    }



    /*
    function imprimir() {
    const container = document.getElementById("svg-container");

    const printWindow = window.open("", "", "width=1100,height=600");

    const styles = Array.from(document.styleSheets)
    .map(styleSheet => {
    try {
    return Array.from(styleSheet.cssRules)
    .map(rule => rule.cssText)
    .join('');
    } catch (e) {
    return '';
    }
    }).join('');

    const clonedContent = container.cloneNode(true);
    clonedContent.style.border = "none"; // Elimina bordes inline

    printWindow.document.open();
    printWindow.document.write(`
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Impresión</title>
        <style>
            $ {
                styles
            }

            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }

            #print-content {
                border: none !important;
                transform: scale(1.4);
                transform-origin: top left;
            }

            svg {
                max-width: 100%;
                height: auto;
            }
        </style>
    </head>

    <body>
        <div id="print-content"></div>
    </body>

    </html>
    `);
    printWindow.document.close();

    printWindow.onload = () => {
    printWindow.document.getElementById("print-content").appendChild(clonedContent);
    printWindow.focus();
    printWindow.print();
    printWindow.close();
    };
    }


    */



    /*  document.addEventListener("DOMContentLoaded", function() {
           const airplane = document.getElementById("airplane");
           const baseUrl = @json($url);
           const img = `avion1`;
           const svgSrc = `${baseUrl}/${img}.svg`;
          // console.log(svgSrc);

           airplane.src = svgSrc;
       });  
     */
</script>
