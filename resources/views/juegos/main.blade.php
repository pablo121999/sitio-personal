<div class="row">

    <div class="col-md-6">
        <div class="card" style="border-radius: 20px; background-color: #f2f2f2;">
            <div class="card-body">
                <a href="{{ route('PersonalizaAvion') }}" class="d-flex align-items-center text-decoration-none"
                    data-toggle="popover" data-trigger="hover" data-content="Personaliza tu avión">
                    <img src="{{ asset('img/PersonalizaAvion.png') }}" height="50" width="50"
                        alt="Personaliza tu avión" class="me-3 rounded" />
                    <span class="text-dark fs-5">Personaliza tu avión</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card" style="border-radius: 20px; background-color: #f2f2f2;">
            <div class="card-body">
                <a href="{{ route('GestionUsuarios') }}" class="d-flex align-items-center text-decoration-none"
                    data-toggle="popover" data-trigger="hover" data-content="Simulador de avión">
                    <img src="{{ asset('img/SimuladorAvion.png') }}" height="50" width="50"
                        alt="Simulador de avión" class="me-3 rounded" />
                    <span class="text-dark fs-5">Simulador de avión</span>
                </a>
            </div>
        </div>
    </div>

</div>
