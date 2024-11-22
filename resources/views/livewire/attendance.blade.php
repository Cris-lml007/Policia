<div>
    <div class="d-flex justify-content-end" style="margin-right: 30px;">
        <a class="btn btn-success"><i class="fa fa-globe"></i> Tomar Posicionamiento GPS</a>
    </div>
    <div class="container label" style="max-width: 95%;">
        <div class="d-flex justify-content-between">
            <h5 class="form_titulo subtitulo">Control de Personal</h5>
            <div class="input-group" style="width: 40%;padding-top: 22px;margin-bottom: 25px;">
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
                @foreach ($persons ?? [] as $person)
                    <tr>
                        <td>{{ $person->range ?? '---' }}</td>
                        <td>{{ $person->surname . ' ' . $person->name }}</td>
                        <td>{{ $person->cellular ?? '---' }}</td>
                        <td><i @class([
                            'fa',
                            'fa-circle',
                            'text-success',
                            'text-danger' => !$person->active,
                        ])></i></td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#modalStaff"
                                wire:click="getPerson({{ $person->ci }})" class="btn btn-success"><i
                                    class="fa fa-eye"></i> Ver Datos</button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>sargento</td>
                    <td>Paredes Garcia Marco</td>
                    <td>999999999</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                            <i class="fa fa-list"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>sargento</td>
                    <td>Marzana Marzana Maria</td>
                    <td>999999999</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                            <i class="fa fa-list"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                {{-- {{$persons->links()}} --}}
            </div>
        </div>
    </div>

    <x-modal id="modal" title="Control de Asistencia">
        <div class="input-group">
            <span class="input-group-text">Controles Realizados</span>
            <input class="form-control" type="number" readonly>
        </div>
        <div class="mt-1 mb-1">
            <button style="width: 100%;" class="btn btn-primary"><i class="fa fa-check"></i> Marca Asistencia</button>
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
        Livewire.hook('morph.updated', (message, component) => {
            const modalElement = document.getElementById('modal');
            if (modalElement) {
                $('#modal').modal('dispose');
                $('#modal').modal('show');
            }
        });
    </script>
@endscript
