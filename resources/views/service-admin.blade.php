@extends('adminlte::page')


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
                    <th>Ubicación de formación (latitud / longitud)</th>
                    <th></th>
                </thead>
                <tr>
                    <td>GV SAN JOSE Vs. THE STRONGEST</td>
                    <td>Programado</td>
                    <td>-17.946398 / -67.111552</td>
                    <td>
                        <button class="button inline_button" data-toggle="collapse" data-parent="#parent" href="#details1">
                            Detalles
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <div class="cont panel-collapse collapse in" data-parent="#parent" id="details1">
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
                    </td>
                </tr>
                <tr>
                    <td>PROCESION DE LA VIRGEN DEL SANTUARIO DEL SOCAVON</td>
                    <td>Programado</td>
                    <td>-17.968767 / -67.103802</td>
                    <td>
                        <button class="button inline_button" data-toggle="collapse" data-parent="#parent" href="#details2">
                            Detalles
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <div class="cont panel-collapse collapse in" data-parent="#parent" id="details2">
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
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection