@include('layouts.header')
<!-- DataTables CSS -->
<script src="{{ asset('js/sweetalert.js') }} "></script>

<x-app-layout>

    <div class="container col-sm-10" style="margin-top: 20px;">
        <h1 class="display-6"><b>Gestión de línea de tiempo</b></h1>

        @if (session('success'))
            <div class="alert alert-success   alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger   alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <script>
            // Espera 5 segundos (5000 ms) y luego cierra la alerta automáticamente
            setTimeout(function() {
                let alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show'); // Oculta visualmente
                    alert.classList.add('fade'); // Aplica transición
                    setTimeout(() => alert.remove(), 300); // Remueve del DOM después de la animación
                }
            }, 5000);
        </script>

    </div>


    <a class="btn btn-primary" href="{{ route('CrearLineaTiempo') }}"
        style="text-decoration: none; margin-left: 1300px;">
        Crear </a>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table id="date_table" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Año</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se insertarán los datos dinámicamente -->
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            // Inicializar DataTable en español
                            const table = $('#date_table').DataTable({
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                                }
                            });

                            // Cargar los datos por AJAX
                            $.ajax({
                                url: '/lista-LineaTiempo',
                                method: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    table.clear(); // Limpiar antes de insertar

                                    if (data.length > 0) {
                                        data.forEach(function(dato, index) {
                                            table.row.add([
                                                index + 1,
                                                dato.ano,
                                                dato.titulo,
                                                dato.descripcion,
                                                `
        <a href="/EditarLineaTiempo/${dato.id}">
            <i class="fa fa-pencil"></i>
        </a>
   `,
                                                ` <a href="#"  onclick="confirmarEliminacion('/EliminarLineaTiempo/${dato.id}');" >
            <i class="fa fa-trash"></i>
        </a>`,

                                            ]);
                                        });
                                        table.draw(); // Redibujar
                                    } else {
                                        $('#date_table tbody').append('<tr><td colspan="3">No hay datos</td></tr>');
                                    }
                                },
                                error: function(error) {
                                    alert('Hubo un error al cargar los datos. Intente nuevamente.');
                                    console.log('Error al cargar los datos:', error);
                                }
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminacion(url) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al enlace original
                    window.location.href = url;
                }
            });
        }
    </script>

</x-app-layout>
@include('layouts.footer')
