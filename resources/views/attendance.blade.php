@extends('adminlte::page')


@section('content')
<div class="general fondo">
    <div style="width: 100%;margin-top: 10px;">
        <div style="width: 100%;display: flex ;justify-content: end;padding-right: 28px;">
        </div>
        <livewire:staff-table />

        <div class="container d-flex flex-wrap">
            <!-- Div para Control QR -->
            <div class="col-12 col-md-6 mb-4">
                <h2 class="form_titulo">Control QR</h2>
                <div id="chartContainer" style="height: 370px; width: 100%; 
                    background-image: url('{{ asset('img/QRLogo.png') }}'); 
                    background-size: cover; 
                    background-position: center; 
                    background-repeat: no-repeat;">
                </div>
                <button class="button inline_button">
                    Generar Codigo
                    <span class="fas fa-qrcode button_span"></span>
                </button>
            </div>
        
            <!-- Div para Control GPS -->
            <div class="col-12 col-md-6">
                <h2 class="form_titulo">Control GPS</h2>
                <div style="height: 370px; width: 100%; 
                    background-image: url('{{ asset('img/GPSLogo.png') }}'); 
                    background-size: contain; 
                    background-position: center; 
                    background-repeat: no-repeat;">
                </div>
                <button class="button inline_button">
                    GPS
                    <span class="fas fa-map-marker-alt button_span"></span>
                </button>
            </div>
        </div>
        
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
