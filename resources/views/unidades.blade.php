@extends('adminlte::page')


@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<title>Gestión de unidades</title>
    <div class="general fondo">
        <div class="container label">
            <h2 class="form_titulo subtitulo">Gestión de unidades</h2>
            <table>
                <thead class="table_header">
                    <th>ID Unidad</th>
                    <th>Nombre de unidad</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>N° Efectivos</th>
                    <th>Comandante</th>
                    <th>Acciones</th>                   
                </thead>
                <tr>
                    <td>4156</td>
                    <td>EPI-1</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                    <td>6 de agosto #123 Aroma y Villarroel</td>
                    <td>20</td>
                    <td>Tcnl. Silva Villafuerte Carlos</td>
                    <td>
                        <button class="button inline_button">
                            Editar
                            <span class="fas fa-pen button_span"></span>
                        </button>
                        <button class="button inline_button">
                            Ver datos
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>7845</td>
                    <td>DIPROVE</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                    <td>6 de agosto #123 Aroma y Villarroel</td>
                    <td>40</td>
                    <td>Tcnl. Silva Villafuerte Carlos</td>
                    <td>
                        <button class="button inline_button">
                            Editar
                            <span class="fas fa-pen button_span"></span>
                        </button>
                        <button class="button inline_button">
                            Ver datos
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
            </table>
            <div class="end">
                <button class="button inline_button">
                    Nueva unidad
                    <span class="fas fa-folder-plus button_span"></span>
                </button>
            </div>
        </div>
    </div>
@endsection