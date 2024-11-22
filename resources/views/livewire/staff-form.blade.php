<div>
    <div class="input-group">
        <span class="input-group-text">CI</span>
        <input wire:model.lazy="ci" type="number" class="form-control" readonly>
    </div>
    <div class="input-group">
        <span class="input-group-text">Apellidos</span>
        <input wire:model.lazy="surname" type="text" class="form-control" readonly>
    </div>
    <div class="input-group">
        <span class="input-group-text">Nombres</span>
        <input wire:model.lazy="name" type="text" class="form-control" readonly>
    </div>
    <div class="input-group">
        <span class="input-group-text">Rango</span>
        <input wire:model.lazy="range" class="form-control" list="hola" readonly>
    </div>
    <div class="input-group">
        <span class="input-group-text">Celular</span>
        <input wire:model.lazy="cellular" type="number" class="form-control" max="8" min="8" readonly>
    </div>
    <div class="input-group">
        <span class="input-group-text">Cargo</span>
        <input wire:model="position" type="text" class="form-control" readonly placeholder="NO DISPONIBLE">
    </div>
    <h5 class="card-text mt-2 mb-2">Credencial de Acceso</h5>
    <div class="input-group">
        <span class="input-group-text">usuario</span>
        <input wire:model="username" class="form-control" readonly>
    </div>
    <div class="input-group">
        <span class="input-group-text">Contraseña</span>
        <input wire:model.live="password_confirmation" type="password" class="form-control">
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Confirmar Contraseña</span>
        <input wire:model.live="password" type="password" class="form-control">
    </div>
    @error('password')
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="form-check form-switch">
        <input wire:click="toggleActive" wire:model="active" class="form-check-input" type="checkbox" role="switch"
            id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault">Bloquear Usuario</label>
    </div>
    <div class="modal-footer px-0">
        <button wire:click="restart" class="btn-secondary btn" data-bs-dismiss="modal">Cerrar</button>
        @if (!$isSave)
            <button wire:click="updatePassword" class="btn-success btn"
                @if (empty($password) or empty($password_confirmation)) disabled @endif>Guardar</button>
        @endif
    </div>
</div>
