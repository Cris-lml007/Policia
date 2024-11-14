@extends('adminlte::page')

@section('content')
    <div class="fondo general">
        <div style="width: 100%;margin-top: 10px;">
            <livewire:attendance />
        </div>
    </div>
    <x-modal id="modal" title="Control de Asistencia">
        <div class="input-group">
            <span class="input-group-text">Controles Realizados</span>
            <input class="form-control" type="number" readonly>
        </div>
        <div class="mt-1 mb-1">
            <button style="width: 100%;" class="btn btn-primary"><i class="fa fa-check"></i> Marca Asistencia</button>
        </div>
        <div class="mt-1 mb-1">
            <button style="width: 100%;" class="btn btn-primary"><i class="fa fa-qrcode"></i> QR</button>
        </div>
    </x-modal>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
