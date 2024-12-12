@extends('adminlte::page')


@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Gestión de unidades</title>
    <div class="general fondo">
        <div class="container label">
            <h2 class="form_titulo subtitulo">Reportes de asistencia</h2>
            <div style="display: flex; justify-content: flex-end;">
                {{-- <select name="servicio" id="servicio" class="select" required="required"> --}}
                {{--     <option value="2">PROCESION DE LA VIRGEN DEL SANTUARIO DEL SOCAVON</option> --}}
                {{-- </select> --}}
                <a href="{{route('dashboard.report')}}" class="button inline_button">
                    Exportar
                    <span class="fas fa-file-export button_span"></span>
                </a>
            </div>
            <div class="container label">
                <ul class="list-group" style="margin-bottom: 1em">
                    <li class="list-group-item">
                        <b>Nombre servicio:</b> {{ $groupService->service->title }}
                    </li>
                    <li class="list-group-item">
                        <b>Fecha de operación:</b>
                        {{ $groupService->service->date_start . ' - ' . $groupService->service->date_end }}
                    </li>
                    <li class="list-group-item">
                        <b>Cantidad efectivos: </b> {{ $groupService->detailService()->count() }}
                    </li>
                    <li class="list-group-item">
                        <b>Total asistencias: </b> {{$attendance}}
                    </li>
                    <li class="list-group-item">
                        <b>Total ausencias: </b> {{ $attendance - $aus->attendance_count}}
                    </li>
                    {{-- <li class="list-group-item"> --}}
                    {{--     <b>Rondas de control realizadas: </b> 3 --}}
                    {{-- </li> --}}
                </ul>
                <table>
                    <thead class="table_header">
                        <th>Rango</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Cargo</th>
                        <th>Asistencia formación</th>
                        <th>Asistencia controles</th>
                    </thead>
                    @foreach ($groupService->detailService as $item)
                    <tr>
                        <td>{{$item->user->range}}</td>
                        <td>{{$item->user->surname}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>NO DISPONIBLE</td>
                        <td><i class="fa fa-circle text-success"></i></td>
                        <td>{{$item->user->detailService()->where('service_id',$groupService->service->id)->first()->attendances()->count()}} </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

