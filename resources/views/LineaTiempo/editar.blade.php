@include('layouts.header')

<x-app-layout>


    <div class="container col-sm-10" style="margin-top: 20px;">
        <h1 class="display-6"><b>Editar línea de tiempo</b></h1>

        @if ($errors->has('passwordActual'))
            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                {{ $errors->first('passwordActual') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" enctype="multipart/form-data"
                        action=" {{ route('actualizarLineaTiempo', ['id' => $LineaTiempo->id]) }}">

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-2 col-form-label"><b>Año *:</b></label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="ano" placeholder="Ingrese el año"
                                    value="{{ $LineaTiempo->ano }}" min="1" step="1" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-2 col-form-label"><b>Título *:</b></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="titulo"
                                    value="{{ $LineaTiempo->titulo }}" placeholder="Ingrese el título" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-2 col-form-label"><b>Descripción *:</b></label>
                            <div class="col-sm-6">
                                <textarea name="descripcion" rows="4" cols="66" placeholder="Escribe la descripción aquí..." required>{{ $LineaTiempo->descripcion }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row" style="margin-bottom: 20px;">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-6">
                                <div class="col-sm-4 text-center">
                                    <img src="{{ asset('storage/' . $LineaTiempo->imagen) }}" width="100px"
                                        height="100px" style="border-radius: 5px;">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row" style="margin-bottom: 50px;">
                            <label for="" class="col-sm-2 col-form-label"><b>Imagen :</b></label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                                <small class="form-text text-muted">Solo se aceptan archivos en formato jpg, jpeg y
                                    png.</small>
                            </div>
                        </div>


                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            @csrf
                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a class="btn btn-primary" href="{{ route('LineaTiempo') }}"
                                style="text-decoration: none; margin-left: 1000px;">
                                Atrás
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
@include('layouts.footer')
