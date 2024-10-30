<div class="container label">
    <div class="d-flex justify-content-between">
        <h5 class="form_titulo subtitulo">Personal</h5>
        <div class="input-group" style="width: 40%;padding-top: 22px;margin-bottom: 25px;">
            <input wire:model.lazy="search" type="text" class="form-control" placeholder="Buscar">
            <button class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <table @update="$refresh">
        <thead class="table_header">
            <th>CI</th>
            <th>Apellidos y Nombres</th>
            <th>Rango</th>
            <th>Cargo</th>
            <th>Unidad</th>
        </thead>
        <tbody>
            @foreach ($persons ?? [] as $person)
            <tr wire:click="getPerson({{$person->id}})" data-bs-toggle="modal" data-bs-target="#modalStaff" class="tr-select">
                <td>{{$person->ci}}</td>
                <td>{{$person->surname . ' ' . $person->name}}</td>
                <td>{{$person->range->name ?? '---'}}</td>
                <td>{{$person->position ?? '---'}}</td>
                <td>Transito</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer">
        <div class="d-flex justify-content-end">
            {{$persons->links()}}
        </div>
    </div>
</div>
