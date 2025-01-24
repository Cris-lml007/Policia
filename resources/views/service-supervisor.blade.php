@extends('adminlte::page')


@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Gestión de unidades</title>
    <div class="general fondo">
        <div class="container label">
            <h2 class="form_titulo subtitulo">Servicio policial</h2>
            {{-- <div class="end"> --}}
            {{--     <button class="button inline_button"> --}}
            {{--         Sincronizar servicio --}}
            {{--         <span class="fas fa-sync"></span> --}}
            {{--     </button> --}}
            {{-- </div> --}}
            <ul class="list-group" style="margin-bottom: 1em">
                <li class="list-group-item">
                    <b>Nombre servicio:</b> {{$service->service->title}}
                </li>
                <li class="list-group-item">
                    <b>Fecha de operación:</b> {{$service->service->date_start . ' - ' .$service->service->date_end}}
                </li>
                <li class="list-group-item">
                    <b>Cantidad grupos: </b> {{$service->service->groupService()->count()}}
                </li>
                <li class="list-group-item">
                    <b>Cantidad efectivos: </b> {{$service->detailService()->count()}}
                </li>
                <li class="list-group-item">
                    <b>Grupo Designado: </b> {{$service->id}}
                </li>
            </ul>
            <livewire:group-map id="{{$service->id}}">
            </livewire:group-map>
        </div>
    </div>
@endsection
