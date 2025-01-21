@extends('adminlte::page')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<title>Gestión de unidades</title>
    <div class="general fondo">
        <div class="container label">
            <h2 class="form_titulo subtitulo">Servicios policiales</h2>
            <div class="end">
                <button class="button inline_button">
                    Sincronizar servicios
                    <span class="fas fa-sync"></span>
                </button>
            </div>

            <table id="parent">
                <thead class="table_header">
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th>Fecha de operación</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($services ?? [] as $key => $service)
                    <tr>
                        <td>{{$service->title}}</td>
                        <td>{{(Carbon::now() < Carbon::parse($service->date_start) ? 'Programado' :
                        (Carbon::now() >= Carbon::parse($service->date_start) && Carbon::now() <= Carbon::parse($service->date_end) ? 'En Progreso' : 'Finalizado'))}}</td>
                        <td>{{$service->date_start . ' - ' . $service->date_end}}</td>
                        <td>
                            <a class="button inline_button" href="{{route('dashboard.getService',$service->id)}}">
                                Detalles
                                <span class="fas fa-eye button_span"></span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer" style="margin-top: 15px;">
                {{$services->links()}}
            </div>
        </div>
    </div>
@endsection
