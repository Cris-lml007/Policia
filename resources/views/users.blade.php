@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<title>Gestión de usuarios</title>
    <div class="general fondo">
        
        <div class="container label">
            <h2 class="form_titulo subtitulo">Gestión de usuarios</h2>
            <table>
                <thead class="table_header">
                    <th>CI</th>
                    <th>Nombre de usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>                   
                </thead>
                <tr>
                    <td>7777777</td>
                    <td>admin</td>
                    <td>Administrador</td>
                    <td>Activo</td>
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
                    <td>7878787</td>
                    <td>admin</td>
                    <td>Administrador</td>
                    <td>Activo</td>
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
                    Nuevo usuario
                    <span class="fas fa-user-plus button_span"></span>
                </button>
            </div>
        </div>
        
    </div>
@endsection