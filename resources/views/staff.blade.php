@extends('adminlte::page')

@section('content')
    <div class="general fondo">
        <div style="width: 100%;margin-top: 10px;">
            <livewire:staff-table />

            {{-- <div style="width: 100%;display: flex ;justify-content: end;padding-right: 28px;"> --}}
            {{--     <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalGrade"> --}}
            {{--         <i class="fa fa-plus"></i> --}}
            {{--         Añadir Grado --}}
            {{--     </button> --}}
            {{-- </div> --}}
            {{-- <livewire:range-table /> --}}

            <x-modal id="modalStaff" title="Añadir Personal" class="modal-xl">
                <livewire:staff-form />
            </x-modal>

            {{-- <x-modal id="modalGrade" title="Añadir Grado"> --}}
            {{--     <livewire:range-form /> --}}
            {{-- </x-modal> --}}
        </div>


    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
