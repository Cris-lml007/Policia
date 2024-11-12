@extends('adminlte::page')


@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<title>Gestión de unidades</title>
    <div class="general fondo">
        <div class="container label">
            <h2 class="form_titulo subtitulo">Servicios policiales</h2>
            <table>
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
                        <button class="button inline_button" data-toggle="collapse" href="#details1" aria-expanded="true" aria-controls="details1">
                            Detalles
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
                <tr class="card-body">
                    <td colspan="4" >
                        <div class="card card-body collapse"id="details1">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia repellendus ut excepturi molestiae, ducimus sunt earum! Dolorem reprehenderit quia necessitatibus, tempora assumenda eum accusamus eveniet sequi odio eligendi. Consequuntur, quidem ducimus tempore doloremque animi assumenda, ex amet earum fuga tempora doloribus ipsa! Nisi distinctio commodi iste sed voluptate a sequi?
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>PROCESION DE LA VIRGEN DEL SANTUARIO DEL SOCAVON</td>
                    <td>Programado</td>
                    <td>-17.968767 / -67.103802</td>
                    <td>
                        <button class="button inline_button" data-toggle="collapse" href="#details2" aria-expanded="true" aria-controls="details2">
                            Detalles
                            <span class="fas fa-eye button_span"></span>
                        </button>
                    </td>
                </tr>
                <tr class="card-body">
                    <td colspan="4" >
                        <div class="card card-body collapse"id="details2">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia repellendus ut excepturi molestiae, ducimus sunt earum! Dolorem reprehenderit quia necessitatibus, tempora assumenda eum accusamus eveniet sequi odio eligendi. Consequuntur, quidem ducimus tempore doloremque animi assumenda, ex amet earum fuga tempora doloribus ipsa! Nisi distinctio commodi iste sed voluptate a sequi?
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection