<div>
    <div class="input-group">
        <span class="input-group-text">CI</span>
        <input wire:model.lazy="ci" type="number" class="form-control">
    </div>
    @error('ci')
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Apellidos</span>
        <input wire:model.lazy="surname" type="text" class="form-control">
    </div>
    @error('surname')
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Nombres</span>
        <input wire:model.lazy="name" type="text" class="form-control">
    </div>
    @error('name')
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Fecha de Nacimiento</span>
        <input wire:model.lazy="birthdate" type="date" class="form-control">
    </div>
    @error('birthdate')
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Genero</span>
        <select wire:model.lazy="gender" class="form-select">
            <option value="null">Seleccione</option>
            <option value=1>Hombre</option>
            <option value=0>Mujer</option>
        </select>
    </div>
    @error('gender')
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="input-group">
        <span class="input-group-text">Rango</span>
        <input wire:model.lazy="range" class="form-control" list="hola">
    </div>
    @error('range')
        <span class="text-danger">
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
        <input wire:model.lazy="cellular" type="number" class="form-control" max="8" min="8">
    </div>
    @error('cellular')
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
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
        <button wire:click="restart" class="btn-secondary btn" data-bs-dismiss="modal">Cancelar</button>
        {{-- @if (!$isSave) --}}
            <button wire:click="updateOrCreate" class="btn-success btn">Guardar</button>
        {{-- @endif --}}
    </div>
</div>
