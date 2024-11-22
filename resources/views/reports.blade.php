@extends('adminlte::page')


@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<title>Gestión de unidades</title>
    <div class="general fondo">
        <div class="container label">
            <h2 class="form_titulo subtitulo">Reportes de asistencia</h2>
            <div style="display: flex; justify-content: space-between;">
                <select name="servicio" id="servicio" class="select" required="required">
                    <option value="2">PROCESION DE LA VIRGEN DEL SANTUARIO DEL SOCAVON</option>
                </select>
                <button class="button inline_button">
                    Exportar
                    <span class="fas fa-file-export button_span"></span>
                </button>
            </div>
            <div class="container label">
                <ul class="list-group" style="margin-bottom: 1em">
                    <li class="list-group-item">
                        <b>Nombre servicio:</b> PROCESION DE LA VIRGEN DEL SANTUARIO DEL SOCAVON
                    </li>
                    <li class="list-group-item">
                        <b>Fecha de operación:</b> 02/02/2025
                    </li>
                    <li class="list-group-item">
                        <b>Cantidad grupos: </b> 1
                    </li>
                    <li class="list-group-item">
                        <b>Cantidad efectivos: </b> 4
                    </li>
                    <li class="list-group-item">
                        <b>Total asistencias: </b> 3
                    </li>
                    <li class="list-group-item">
                        <b>Total ausencias: </b> 1
                    </li>
                    <li class="list-group-item">
                        <b>Rondas de control realizadas: </b> 3
                    </li>
                </ul>
                <table>
                    <thead class="table_header">
                        <th>Rango</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Nombres</th>
                        <th>Cargo</th>
                        <th>Asistencia formación</th>
                        <th>Asistencia controles</th>
                    </thead>
                    <tr>
                        <td>Sargento 1°</td>
                        <td>Magne</td>
                        <td>Choque</td>
                        <td>Aldo</td>
                        <td>Supervisor</td>
                        <td><i class="fa fa-circle text-success"></i></td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>Sargento</td>
                        <td>Lopez</td>
                        <td>Lopez</td>
                        <td>José Ignacio</td>
                        <td>Efectivo</td>
                        <td><i class="fa fa-circle text-success"></i></td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>Sargento</td>
                        <td>Velasquez</td>
                        <td>Condori</td>
                        <td>Victor Manuel</td>
                        <td>Efectivo</td>
                        <td><i class="fa fa-circle text-success"></i></td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>Sargento</td>
                        <td>Quispe</td>
                        <td>Llanque</td>
                        <td>Angel</td>
                        <td>Efectivo</td>
                        <td><i class="fa fa-circle text-danger"></i></td>
                        <td>2</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection