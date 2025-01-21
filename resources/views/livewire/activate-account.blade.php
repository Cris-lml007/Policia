<div>
    <div class="alert alert-warning" role="alert">
        <p>Usted debe definir su contraseña para acceder al sistema.</p>
        <ul>
            <li>La contraseña debe ser mayor a 8 caracteres</li>
            <li>Debe contener al menos un numero</li>
            <li>Debe contener al menos una letra Mayuscula y Minuscula</li>
        </ul>
    </div>
    <div class="card m-3">
        <div class="card-body">
            <div class="input-group">
                <span class="input-group-text">Usuario</span>
                <input type="text" disabled value="{{ $username }}" class="form-control">
            </div>
            <div class="input-group">
                <span class="input-group-text">Contraseña</span>
                <input type="password" class="form-control" wire:model.live="password">
            </div>
            <div class="input-group">
                <span class="input-group-text">Confimar Contraseña</span>
                <input type="password" class="form-control" wire:model.live="password1">
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="button" wire:click="changePassword">
                    <i class="nf nf-fa-save"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        Livewire.on('error', () => {
            Swal.fire({
                title: "Oops...",
                text: "Parece que la contraseña no es valida.",
                icon: "error"
            });

        });
    </script>
@endscript
