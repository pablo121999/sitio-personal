@include('layouts.header')
<!-- DataTables CSS -->

<x-app-layout>

    <div class="container col-sm-10" style="margin-top: 20px;">
        <h1 class="display-6"><b>Gestión de usuarios</b></h1>

        @if (session('success'))
            <div class="alert alert-success   alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

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
        @endif
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table id="date_table"
                        class="tablaGen table table-striped table-condensed table-hover tablaGenPagine dataTable no-footer">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>correo</th>
                                <th>Editar</th>
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
                                url: '/lista-usuarios',
                                method: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    table.clear(); // Limpiar antes de insertar

                                    if (data.length > 0) {
                                        data.forEach(function(dato, index) {
                                            table.row.add([
                                                index + 1,
                                                dato.name,
                                                dato.email,
                                                `<div style="display: flex; align-items: center; gap: 10px;">
        <a href="/EditarUsuarios/${dato.id}">
            <i class="fa fa-pencil"></i>
        </a>
    </div>`
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

</x-app-layout>
@include('layouts.footer')
