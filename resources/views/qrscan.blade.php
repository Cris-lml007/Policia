@extends('adminlte::page')

@section('content')
    <div class="general fondo">
        <div style="width: 100%;margin-top: 10px;">
            <div class="container label">
                <h5 class="form_titulo subtitulo">Escanear QR</h5>
                <div id="message"></div>
                <livewire:qr-scan>
                </livewire:qr-scan>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
