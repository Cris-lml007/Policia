<div>
    <div style="width: 100%;display: flex ;justify-content: end;padding-right: 40px;">
        <button id="sync" class="btn btn-success">
            <i class="fa fa-sync"></i>
            Sincronizar Personal
        </button>
    </div>
    <div class="container label" style="max-width: 95%;">
        <div class="d-flex justify-content-between">
            <h5 class="form_titulo subtitulo">Gestión de Personal</h5>
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
                <th>Estado</th>
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
            </tbody>
        </table>
        <div class="card-footer" style="margin-top: 15px;">
            <div class="d-flex justify-content-end">
                {{ $persons->links() }}
            </div>
        </div>
    </div>
    @can('admin')
        <div class="container-float">
            <button data-bs-toggle="modal" data-bs-target="#modalStaff" wire:click="newLocal" style="border-radius: 50%;width: 60px;height: 60px;font-size: 25px;box-shadow: 0px 0px 5px black;"
                class="btn btn-primary">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    @endcan
</div>

@script
    <script>
        let btnSync = document.getElementById('sync');
        btnSync.addEventListener('click', () => {
            let timerInterval;
            let Swal = window.Swal;
            Swal.fire({
                title: "Sincronizando",
                html: "por favor espera a que termine la sincronización",
                timer: 0,
                didOpen: () => {
                    Swal.showLoading();
                    timerInterval = setInterval(() => {
                        if ($wire.message == 1) {
                            Swal.close();
                            Swal.fire({
                                'title': 'Finalizado',
                                'text': 'Sincronización completada exitosamente.',
                                'icon': 'success'

                            });
                            clearInterval(timerInterval);
                        } else if ($wire.message == -1) {
                            Swal.fire({
                                'title': 'Hubo un Error',
                                'text': 'No se pudo completar la sincronización.',
                                'icon': 'error'

                            });
                            clearInterval(timerInterval);
                        }
                    }, 1000);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
            $wire.dispatch('syncStaff');
        });
    </script>
@endscript
