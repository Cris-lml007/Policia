<div>
    <div class="d-flex justify-content-end" style="margin-right: 30px;">
        <a onclick="alert('No se encontro Dispositivos')" class="btn btn-success"><i class="fa fa-globe"></i> Tomar Posicionamiento GPS</a>
    </div>
    <div class="container label" style="max-width: 95%;">
        <h5 class="form_titulo subtitulo">Control de Personal</h5>
        <div class="d-flex justify-content-between">
            <div class="input-group" style="width: 100%;padding-top: 22px;margin-bottom: 25px;">
                <input wire:model.lazy="search" type="text" class="form-control" placeholder="Buscar">
                <button class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <table @update="$refresh">
            <thead class="table_header">
                <th>Grado</th>
                <th>Apellidos y Nombres</th>
                <th>Celular</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($group ?? [] as $person)
                    <tr>
                        <td>{{ $person->user->range ?? '---' }}</td>
                        <td>{{ $person->user->surname . ' ' . $person->user->name }}</td>
                        <td>{{ $person->user->cellular ?? '---' }}</td>
                        <td>
                            <button wire:click="getAttendance({{ $person->user->id }})" class="btn btn-primary">
                                <i class="fa fa-list"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer" style="margin-top: 15px;">
            <div class="d-flex justify-content-end">
                {{ $group?->links() }}
            </div>
        </div>
    </div>

    <x-modal id="modal" title="Control de Asistencia">
        <div class="input-group">
            <span class="input-group-text">Controles Realizados</span>
            <input wire:model="attendance_quantity" class="form-control" type="number" readonly>
        </div>
        <div class="mt-1 mb-1">
            <button wire:click="manualAttendance" style="width: 100%;" class="btn btn-primary"><i
                    class="fa fa-check"></i> Marca Asistencia</button>
        </div>
        <div class="mt-1 mb-1">
            <button wire:click="qr" style="width: 100%;" class="btn btn-primary"><i class="fa fa-qrcode"></i>
                QR</button>
        </div>
        @if ($isQr)
            <livewire:qr-code />
            <button wire:click="canceledQr" class="btn btn-danger">Cancelar QR</button>
        @endif
    </x-modal>
</div>

@script
    <script>
        const modalElement = document.getElementById('modal');
        if (modalElement) {
            Livewire.on('openModal', (event) => {
                $('#modal').modal('dispose');
                $('#modal').modal('show');
            });
        }
    </script>
@endscript
