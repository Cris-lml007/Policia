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
                            <button class="button inline_button" data-toggle="collapse" data-parent="#parent" href="#details{{$key}}">
                                Detalles
                                <span class="fas fa-eye button_span"></span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" >
                            <div class="cont panel-collapse collapse in" data-parent="#parent" id="details{{$key}}">
                                <p class="label">
                                <b>Cantidad grupos: </b> {{$service->groupService()->count()}} &emsp;&emsp;
                                <b>Cantidad efectivos: </b> {{$service->detailService()->count() + $service->groupService()->count()}}
                                </p>
                                <p class="label subtitulo">Personal asignado a la operación:<br></p>
                                <table>
                                    <thead class="table_header color_header">
                                        <th>Rango</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Nombres</th>
                                        <th>Celular</th>
                                        <th>Cargo</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($service->GroupService as $detail)
                                        <tr>
                                            <td>{{$detail->supervisor->range}}</td>
                                            <td>{{explode(' ',$detail->supervisor->surname)[0]}}</td>
                                            <td>{{explode(' ',$detail->supervisor->surname)[1]}}</td>
                                            <td>{{$detail->supervisor->name}}</td>
                                            <td>{{$detail->supervisor->cellular}}</td>
                                            <td>Supervisor</td>
                                        </tr>
                                        @endforeach
                                        @foreach ($service->detailService as $detail)
                                        <tr>
                                            <td>{{$detail->user->range}}</td>
                                            <td>{{explode(' ',$detail->user->surname)[0]}}</td>
                                            <td>{{explode(' ',$detail->user->surname)[1]}}</td>
                                            <td>{{$detail->user->name}}</td>
                                            <td>{{$detail->user->cellular}}</td>
                                            <td>Personal</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
