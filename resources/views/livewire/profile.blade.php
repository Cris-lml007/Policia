<div class="general fondo">
    <div class="container label">
        <div>
            <h5 class="form_titulo subtitulo">Perfil</h5>
            <div class="input-group">
                <span class="input-group-text">Apellido</span>
                <input class="form-control" value="{{ $surname }}" readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text">Nombre</span>
                <input class="form-control" value="{{ $name }}" readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text">Grado</span>
                <input class="form-control" value="{{ $range }}" readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text">Celular</span>
                <input class="form-control" value="{{ $cellular }}" readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text">Usuario</span>
                <input class="form-control" value="{{ $username }}" readonly>
            </div>
            @if ($token)
                <div class="input-group">
                    <span class="input-group-text">Token</span>
                    <input class="form-control" value="{{ $token }}" readonly>
                </div>
                <div class="alert alert-warning">
                    Copie el token y guárdale en un lugar seguro. No podrá verlo nuevamente.
                </div>
            @else
                <a wire:click="generateToken" class="btn btn-primary mt-1"><i class="fa fa-code"></i> Generar Token</a>
            @endif
        </div>
    </div>
</div>

@assets
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endassets

@script
    <script>
        Livewire.on('alert', message => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo generar el token',
            });
        });
    </script>
@endscript
