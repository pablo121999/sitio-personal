@include('layouts.header')
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('GestionUsuarios') }}"
                                class="d-flex align-items-center text-decoration-none" data-toggle="popover"
                                data-trigger="hover" data-content="Gestión de usuarios">
                                <img src="{{ asset('storage/GestionUsuario.png') }}" height="50" width="50"
                                    alt="Gestión de usuarios" class="me-3 rounded" />
                                <span class="text-dark fs-5">Gestión de usuarios</span>
                            </a>
                        </div>

                        <div class="col-sm-6">
                            <a href="{{ route('LineaTiempo') }}" class="d-flex align-items-center text-decoration-none"
                                data-toggle="popover" data-trigger="hover" data-content="Gestión de línea de tiempo">
                                <img src="{{ asset('storage/cronologia.png') }}" height="50" width="50"
                                    alt="Gestión de línea de tiempo" class="me-3 rounded" />
                                <span class="text-dark fs-5">Gestión de línea de tiempo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @php
    /*    Auth::user()?->id ?? 'no hay id';
        Auth::user()?->name ?? 'Invitado';
        Auth::user()?->email ?? 'Invitado'; */
    @endphp

</x-app-layout>
@include('layouts.footer')
