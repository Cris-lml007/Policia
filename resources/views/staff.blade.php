@extends('adminlte::page')

@section('content_header')
    <h1>Gestión de Personal</h1>
@endsection

@section('content')
    <div class="d-flex justify-content-end mb-1">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">
            <i class="fa fa-plus"></i>
            Añadir Personal
        </button>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Personal</h5>
            <div class="d-flex justify-content-end">
                <div class="input-group" style="width: 40%;">
                    <input type="text" class="form-control" placeholder="Buscar">
                    <button class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>CI</th>
                    <th>Apellidos y Nombres</th>
                    <th>Rango</th>
                    <th>Cargo</th>
                    <th>Unidad</th>
                </thead>
                <tbody>
                    <tr>
                        <td>123123</td>
                        <td>fdjlfkjsad sdfsafsd</td>
                        <td>coronel</td>
                        <td>secretario general</td>
                        <td>Transito</td>
                    </tr>
                    <tr>
                        <td>123123</td>
                        <td>fdjlfkjsa sdfsafsd</td>
                        <td>coronel</td>
                        <td>secretario general</td>
                        <td>Transito</td>
                    </tr>
                    <tr>
                        <td>123123</td>
                        <td>fdjlfkjsad sdfsafsd</td>
                        <td>coronel</td>
                        <td>secretario general</td>
                        <td>Transito</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-1">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalGrade">
            <i class="fa fa-plus"></i>
            Añadir Grado
        </button>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Grados</h5>
            <div class="d-flex justify-content-end">
                <div class="input-group" style="width: 40%;">
                    <input type="text" class="form-control" placeholder="Buscar">
                    <button class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="modal" title="Añadir Personal" class="modal-lg">
        <div class="input-group">
            <span class="input-group-text">CI</span>
            <input type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-text">Apellidos</span>
            <input type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-text">Nombres</span>
            <input type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-text">Fecha de Nacimiento</span>
            <input type="date" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-text">Genero</span>
            <select name="" id="" class="form-select">
                <option value="null">Seleccione</option>
                <option value="1">Hombre</option>
                <option value="0">Mujer</option>
            </select>
        </div>
        <div class="input-group">
            <span class="input-group-text">Rango</span>
            <input class="form-control" list="hola">
        </div>
        <div class="input-group">
            <span class="input-group-text">Cargo</span>
            <input type="text" class="form-control">
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
        <datalist id="hola" style="background-color: ;">
            <option value="hola"></option>
            <option value="como"></option>
            <option value="ppp"></option>
        </datalist>
        <div class="form-floating">
            <textarea class="form-control" id="observations"></textarea>
            <label for="observations">Observaciones</label>
        </div>
        <x-slot name="footer">
            <button class="btn-secondary btn" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn-success btn" data-bs-dismiss="modal">Guardar</button>
        </x-slot>
    </x-modal>

    <x-modal id="modalGrade" title="Añadir Grado">
        <div class="input-group">
            <span class="input-group-text">Grado</span>
            <input type="text" class="form-control">
        </div>
        <x-slot name="footer">
            <button class="btn-secondary btn" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn-success btn" data-bs-dismiss="modal">Guardar</button>
        </x-slot>
    </x-modal>
    @endsection
