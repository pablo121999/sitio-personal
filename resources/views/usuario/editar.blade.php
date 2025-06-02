@include('layouts.header')

<x-app-layout>


    <div class="container col-sm-10" style="margin-top: 20px;">
        <h1 class="display-6"><b>Actualizar usuario</b></h1>

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
                        action="{{ route('actualizar', ['id' => $user->id]) }}">

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-4 col-form-label"><b>Nombre completo *:</b></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                    placeholder="Ingrese el nombre del plan" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-4 col-form-label"><b>Correo electrónico *:</b></label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                    placeholder="Ingrese el correo electrónico: ejemplo@email.com" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-4 col-form-label"><b>Contraseña actual *:</b></label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="passwordActual" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="" class="col-sm-4 col-form-label"><b>Nueva contraseña *:</b></label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="passwordNuevo" required>
                            </div>
                        </div>

                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            @csrf
                            <button type="submit" class="btn btn-success" style="margin-right: 10px;">Guardar</button>
                            <a class="btn btn-primary" href="{{ route('GestionUsuarios') }}"
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
