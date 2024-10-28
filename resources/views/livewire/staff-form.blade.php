<div>
    <div class="input-group">
        <span class="input-group-text">CI</span>
        <input wire:model="ci" type="text" class="form-control">
    </div>
    @error('ci')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Apellidos</span>
        <input wire:model="surname" type="text" class="form-control">
    </div>
    @error('surname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Nombres</span>
        <input wire:model="name" type="text" class="form-control">
    </div>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Fecha de Nacimiento</span>
        <input wire:model="birthdate" type="date" class="form-control">
    </div>
    @error('birthdate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Genero</span>
        <select wire:model="gender" class="form-select">
            <option value="null">Seleccione</option>
            <option value=1>Hombre</option>
            <option value=0>Mujer</option>
        </select>
    </div>
    @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Rango</span>
        <input wire:model="range" class="form-control" list="hola">
    </div>
    @error('range')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Cargo</span>
        <input wire:model="position" type="text" class="form-control">
    </div>
    <div class="input-group">
        <span class="input-group-text">Unidad</span>
        <select class="form-select">
            <option value="">seleccione</option>
        </select>
    </div>
    <div class="input-group">
        <span class="input-group-text">Division</span>
        <select class="form-select">
            <option value="">seleccione</option>
        </select>
    </div>
    <div class="input-group">
        <span class="input-group-text">Celular</span>
        <input wire:model="cellular" type="number" class="form-control">
    </div>
    <datalist id="hola" style="background-color: ;">
        @foreach ($this->getRanges() as $range)
            <option value="{{ $range->name }}"></option>
        @endforeach
    </datalist>
    <div class="form-floating">
        <textarea wire:model="observation" class="form-control" id="observations"></textarea>
        <label for="observations">Observaciones</label>
    </div>
    <div class="modal-footer px-0">
        <button class="btn-secondary btn" data-bs-dismiss="modal">Cancelar</button>
        @if (!$isSave)
            <button wire:click="updateOrCreate" class="btn-success btn">Guardar</button>
        @endif
    </div>
</div>
