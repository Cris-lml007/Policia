@extends('adminlte::page')

@section('content')
    <div class="general fondo">
        <div style="width: 100%;margin-top: 10px;">
            <livewire:staff-table />
            <x-modal id="modalStaff" title="Personal" class="modal-xl">
                <livewire:staff-form />
            </x-modal>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
