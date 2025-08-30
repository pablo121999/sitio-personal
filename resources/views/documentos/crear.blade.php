@include('layouts.header')

<x-app-layout>

    <div class="container col-sm-10" style="margin-top: 20px;">
        <h1 class="display-6"><b>Crear documento</b></h1>
    </div>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('CrearDocumento') }}">

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-2 col-form-label"><b>Documento *:</b></label>
                            <div class="col-sm-6">
                                <input type="file" accept="image/*,.pdf,.doc,.docx" class="form-control"
                                    id="inputImagen" name="documento" required>
                                <small class="form-text text-muted" style="display: block;">Solo se aceptan archivos en
                                    formato jpg, jpeg y
                                    png, pdf, word.</small>
                                <small id="errorImagen" class="text-danger  form-text" style="display: block;"></small>
                            </div>
                        </div>


                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"
                            style="margin-top: 100px;">
                            @csrf
                            <button type="submit" class="btn btn-success" style="margin-right: 10px;">Enviar</button>
                            <a class="btn btn-primary" href="{{ route('GestionDocumentos') }}"
                                style="text-decoration: none; margin-left: 1000px;">
                                Atrás
                            </a>
                        </div>

                    </form>

                    @if (!empty($respuesta))
                        <label>Respuesta</label>
                        <div class="form-group row mb-4">
                            <div class="col-sm-6">
                                {{ $respuesta }}
                            </div>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="{{ route('storeLineaTiempo') }}">
                            <button type="submit" class="btn btn-success" style="margin-right: 10px;">Guardar</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>




    <script>
        document.getElementById('inputImagen').addEventListener('change', function() {
            const file = this.files[0];
            const errorSpan = document.getElementById('errorImagen');

            if (file && file.size > 2 * 1024 * 1024) { // 2 MB
                errorSpan.textContent = 'La imagen supera los 2 MB. Por favor, selecciona una más liviana.';
                this.value = ''; // Limpiar el input para forzar una nueva selección
            } else {
                errorSpan.textContent = '';
            }
        });
    </script>


</x-app-layout>
@include('layouts.footer')
