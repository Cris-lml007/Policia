<div class="container label">
    <div class="d-flex justify-content-between">
        <h2 class="form_titulo subtitulo">Grados</h2>
        <div class="input-group" style="width: 40%;padding-top: 25px;margin-bottom: 15px;">
            <input wire:model.lazy="search" type="text" class="form-control" placeholder="Buscar">
            <button class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <table @refreshRange="$refresh">
        <thead class="table_header">
            <th>Id</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            @foreach ($ranges ?? [] as $range)
            <tr>
                <td>{{$range->id}}</td>
                <td>{{$range->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
