<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/style.css"> <!-- Cambiar por la ruta correcta -->
    <title>Gestión de unidades - Reportes de asistencia</title>
    <style>
        /* Estilos en línea si `style.css` no es compatible con DOMPDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .general {
            padding: 20px;
        }

        .container {
            margin: 0 auto;
            max-width: 800px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .logo-container {
            text-align: center;
            /* Centra el contenido del contenedor */
            margin-bottom: 20px;
        }

        .logo-container img {
            display: block;
            margin: 0 auto;
            /* Centra la imagen */
            width: 50px;
            /* Ajusta el tamaño del logo */
            height: auto;
        }

        .logo-container h2 {
            margin: 10px 0 0 0;
            /* Espaciado superior e inferior */
            font-size: 24px;
            color: #333;
        }

        ul.list-group {
            list-style: none;
            padding: 0;
        }

        ul.list-group li {
            margin-bottom: 10px;
            padding: 10px;
            background: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .text-success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="general">
        <div class="container">
            <div class="logo-container">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/PoliciaLogo.png'))) }}"
                    <h2>Reportes de asistencia</h2>
            </div>
            <div class="container">
                <ul class="list-group" style="margin-bottom: 1em;">
                    <li class="list-group-item"><b>Nombre servicio:</b> {{ $groupService->service->title }}</li>
                    <li class="list-group-item">
                        <b>Fecha de operación:</b>
                        {{ $groupService->service->date_start . ' - ' . $groupService->service->date_end }}
                    </li>
                    <li class="list-group-item"><b>Cantidad efectivos:</b> {{ $groupService->detailService()->count() }}
                    </li>
                    <li class="list-group-item"><b>Total asistencias:</b> {{ $attendance }}</li>
                    <li class="list-group-item"><b>Total ausencias:</b> {{ $attendance - $aus->attendance_count }}</li>
                </ul>
                <table>
                    <thead>
                        <tr>
                            <th>Rango</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Cargo</th>
                            <th>Asistencia controles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupService->detailService as $item)
                            <tr>
                                <td>{{ $item->user->range }}</td>
                                <td>{{ $item->user->surname }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>NO DISPONIBLE</td>
                                <td>{{ $item->user->detailService()->where('service_id', $groupService->service->id)->first()->attendances()->count() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="text-align: center; margin-top: 150px;">
                <div style="display: inline-block; width: 200px; border-top: 1px solid #000; margin-bottom: 10px;">
                </div>
                <div>
                    <h5 style="margin: 0;">
                        {{ $groupService->supervisor->surname . ' ' . $groupService->supervisor->name }}</h5>
                    <h6 style="margin: 0;">{{ $groupService->supervisor->ci }}</h6>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
