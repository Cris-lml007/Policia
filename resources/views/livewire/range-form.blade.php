<div>
    <div class="input-group">
        <span class="input-group-text">Grado</span>
        <input wire:model="name" type="text" class="form-control">
    </div>
    <div class="modal-footer px-0">
        <button class="btn-secondary btn" data-bs-dismiss="modal">Cancelar</button>
        <button wire:click="createOrUpdate" class="btn-success btn" data-bs-dismiss="modal">Guardar</button>
    </div>
</div>
