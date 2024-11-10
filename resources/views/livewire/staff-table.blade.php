<div class="container label" style="max-width: 95%;">
        <h5 class="form_titulo subtitulo">Gestión de Usuarios</h5>
    {{-- <div class="d-flex justify-content-between"> --}}
    {{--     <div class="input-group" style="width: 40%;padding-top: 22px;margin-bottom: 25px;"> --}}
    {{--         <input wire:model.lazy="search" type="text" class="form-control" placeholder="Buscar"> --}}
    {{--         <button class="btn btn-primary"> --}}
    {{--             <i class="fa fa-search"></i> --}}
    {{--         </button> --}}
    {{--     </div> --}}
    {{-- </div> --}}
    <table @update="$refresh">
        <thead class="table_header">
            {{-- <th>CI</th> --}}
            <th>Grado</th>
            <th>Apellidos y Nombres</th>
            <th>Celular</th>
            <th>Estado</th>
            {{-- <th>Cargo</th> --}}
            {{-- <th>Unidad</th> --}}
        </thead>
        <tbody>
            <tr>
                <td>sadfads</td>
                <td>sadfads</td>
                <td>sadfads</td>
                <td>sadfads</td>
            </tr>
            @foreach ($persons ?? [] as $person)
            <tr  wire:click="getPerson({{$person->id}})" data-bs-toggle="modal" data-bs-target="#modalStaff" class="tr-select">
                {{-- <td>{{$person->ci}}</td> --}}
                <td>{{$person->range->name ?? '---'}}</td>
                <td>{{$person->surname . ' ' . $person->name}}</td>
                <td>99999999</td>
                <td><i class="text-danger fa fa-circle"></i></td>
                {{-- <td>{{$person->position ?? '---'}}</td> --}}
                {{-- <td>Transito</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer">
        <div class="d-flex justify-content-end">
            {{-- {{$persons->links()}} --}}
        </div>
    </div>
</div>
