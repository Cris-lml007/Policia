<div class="card">
    <div class="card-body">
        <h5 class="card-title">Personal</h5>
        <div class="d-flex justify-content-end">
            <div class="input-group" style="width: 40%;">
                <input wire:model.lazy="search" type="text" class="form-control" placeholder="Buscar">
                <button class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <table class="table table-striped" @update="$refresh">
            <thead>
                <th>CI</th>
                <th>Apellidos y Nombres</th>
                <th>Rango</th>
                <th>Cargo</th>
                <th>Unidad</th>
            </thead>
            <tbody>
                @foreach ($persons ?? [] as $person)
                <tr>
                    <td>{{$person->ci}}</td>
                    <td>{{$person->surname . ' ' . $person->name}}</td>
                    <td>{{$person->range}}</td>
                    <td>{{$person->position}}</td>
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
</div>
