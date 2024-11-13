@extends('adminlte::page')


@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<title>Gestión de unidades</title>
    <div class="general fondo">
        <div class="container label">
            <h2 class="form_titulo subtitulo">Servicio policial</h2>
            <div class="end">
                <button class="button inline_button">
                    Sincronizar servicio
                    <span class="fas fa-sync"></span>
                </button>
            </div>
            <ul class="list-group" style="margin-bottom: 1em">
                <li class="list-group-item">
                    <b>Nombre servicio:</b> GV SAN JOSE Vs. THE STRONGEST
                </li>
                <li class="list-group-item">
                    <b>Fecha de operación:</b> 16/12/2024
                </li>
                <li class="list-group-item">
                    <b>Cantidad grupos: </b> 4 
                </li>
                <li class="list-group-item">
                    <b>Cantidad efectivos: </b> 16 
                </li>
              </ul>
            <p class="label subtitulo">GRUPO 1</p>
            <table>
                <thead class="table_header">
                    <th>Rango</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombres</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                </thead>
                <tr>
                    <td>Sargento 1°</td>
                    <td>Magne</td>
                    <td>Choque</td>
                    <td>Aldo</td>
                    <td>73847278</td>
                    <td>Supervisor</td>
                </tr>
                <tr>
                    <td>Sargento</td>
                    <td>Lopez</td>
                    <td>Lopez</td>
                    <td>José Ignacio</td>
                    <td>71853397</td>
                    <td>Efectivo</td>
                </tr>
            </table>
            <br>
            <p class="label subtitulo">GRUPO 2</p>
            <table>
                <thead class="table_header">
                    <th>Rango</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombres</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                </thead>
                <tr>
                    <td>Sargento 1°</td>
                    <td>Magne</td>
                    <td>Choque</td>
                    <td>Aldo</td>
                    <td>73847278</td>
                    <td>Supervisor</td>
                </tr>
                <tr>
                    <td>Sargento</td>
                    <td>Velasquez</td>
                    <td>Condori</td>
                    <td>Victor Manuel</td>
                    <td>73973335</td>
                    <td>Efectivo</td>
                </tr>
                <tr>
                    <td>Sargento</td>
                    <td>Quispe</td>
                    <td>Llanque</td>
                    <td>Angel</td>
                    <td>68335663</td>
                    <td>Efectivo</td>
                </tr>
            </table>
            <br>
            <p class="label subtitulo">GRUPO 3</p>
            <table>
                <thead class="table_header">
                    <th>Rango</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombres</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                </thead>
                <tr>
                    <td>Sargento 1°</td>
                    <td>Magne</td>
                    <td>Choque</td>
                    <td>Aldo</td>
                    <td>73847278</td>
                    <td>Supervisor</td>
                </tr>
                <tr>
                    <td>Sargento</td>
                    <td>Velasquez</td>
                    <td>Condori</td>
                    <td>Victor Manuel</td>
                    <td>73973335</td>
                    <td>Efectivo</td>
                </tr>
                <tr>
                    <td>Sargento</td>
                    <td>Quispe</td>
                    <td>Llanque</td>
                    <td>Angel</td>
                    <td>68335663</td>
                    <td>Efectivo</td>
                </tr>
            </table>
            <br>
            <p class="label subtitulo">GRUPO 4</p>
            <table>
                <thead class="table_header">
                    <th>Rango</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombres</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                </thead>
                <tr>
                    <td>Sargento 1°</td>
                    <td>Magne</td>
                    <td>Choque</td>
                    <td>Aldo</td>
                    <td>73847278</td>
                    <td>Supervisor</td>
                </tr>
                <tr>
                    <td>Sargento</td>
                    <td>Velasquez</td>
                    <td>Condori</td>
                    <td>Victor Manuel</td>
                    <td>73973335</td>
                    <td>Efectivo</td>
                </tr>
                <tr>
                    <td>Sargento</td>
                    <td>Quispe</td>
                    <td>Llanque</td>
                    <td>Angel</td>
                    <td>68335663</td>
                    <td>Efectivo</td>
                </tr>
            </table>
        </div>
    </div>
@endsection