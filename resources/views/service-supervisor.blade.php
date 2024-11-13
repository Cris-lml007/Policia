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
            <p class="label">
                <b>Servicio:</b> GV SAN JOSE Vs. THE STRONGEST&emsp;&emsp;
                <b>Fecha de operación:</b> 16/12/2024 <br>
                <b>Cantidad grupos: </b> 4 &emsp;&emsp;
                <b>Cantidad efectivos: </b> 16
            </p>
            
            <table>
                <thead class="table_header">
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th>Fecha de operación</th>
                    <th></th>
                </thead>
                <tr>
                    <td>GV SAN JOSE Vs. THE STRONGEST</td>
                    <td>Programado</td>
                    <td>16/12/2024</td>
                    <td>
                        <button class="button inline_button" data-toggle="collapse" data-parent="#parent" href="#details1">
                            Detalles
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    
                </tr>
                <tr>
                    <td>PROCESION DE LA VIRGEN DEL SANTUARIO DEL SOCAVON</td>
                    <td>Programado</td>
                    <td>02/02/2025</td>
                    <td>
                        <button class="button inline_button" data-toggle="collapse" data-parent="#parent" href="#details2">
                            Detalles
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    
                </tr>
            </table>
        </div>
    </div>
@endsection