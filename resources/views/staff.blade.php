@extends('adminlte::page')

@section('content_header')
    <h1>Gestión de Personal</h1>
@endsection

@section('content')
    <div class="d-flex justify-content-end mb-1">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalStaff">
            <i class="fa fa-plus"></i>
            Añadir Personal
        </button>
    </div>

    <livewire:staff-table />

    <div class="d-flex justify-content-end mb-1">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalGrade">
            <i class="fa fa-plus"></i>
            Añadir Grado
        </button>
    </div>
    <livewire:range-table/>

    <x-modal id="modalStaff" title="Añadir Personal" class="modal-xl">
        <livewire:staff-form />
    </x-modal>

    <x-modal id="modalGrade" title="Añadir Grado">
        <livewire:range-form/>
    </x-modal>
    @endsection
