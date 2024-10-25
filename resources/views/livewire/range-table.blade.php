<div class="card">
    <div class="card-body">
        <h5 class="card-title">Grados</h5>
        <div class="d-flex justify-content-end">
            <div class="input-group" style="width: 40%;">
                <input wire:model.lazy="search" type="text" class="form-control" placeholder="Buscar">
                <button class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <table class="table table-striped" @refreshRange="$refresh">
            <thead>
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
</div>
