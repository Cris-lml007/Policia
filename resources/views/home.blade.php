@extends('adminlte::page')

@section('php')
<?php

$dataPoints = array(
	array("label"=>"Concluidas", "symbol" => "Concluidas","y"=>62.4),
	array("label"=>"En proceso", "symbol" => "En proceso","y"=>10.1),
	array("label"=>"Canceladas", "symbol" => "Canceladas","y"=>7.3),
	array("label"=>"En espera", "symbol" => "En espera","y"=>20.2)
)
?>
@endsection

@section('content')

<title>Página principal</title>
    <div class="general fondo">

        <div class="container principal" style="padding: 0%">
                <style>background-image: url('img/PoliciaLogo.png');</style>
                <div style="padding: 3rem">
                    <h1 class="subtitulo titulo" style="margin: 0%">Sistema de planificación<br>de operaciones</h1>
                    <h2 class="subtitulo"> Bienvenido al sistema</h2>
                    <div style="text-align: left">
                        <button class="button inline_button">
                            Ver perfil
                            <span class="fas fa-id-card button_span"></span>
                        </button>
                    </div>
                </div>


        </div>

            <div class="container" style="max-width: 80%">
                <h2 class="form_titulo"> Resumen operaciones</h2>
                <div>
                    <script>
                        window.onload = function() {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            theme: "light1",
                            animationEnabled: true,
                            data: [{
                                type: "doughnut",
                                indexLabel: "{symbol} - {y}",
                                yValueFormatString: "#,##0.0\"%\"",
                                showInLegend: true,
                                legendText: "{label} : {y}",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                        }
                    </script>
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                </div>

            </div>

            <div class="container d-none" style="max-width: 80%">
                <h2 class="form_titulo subtitulo"> Próximas operaciones </h2>

                <table>
                    <tr>
                        <td>Control entrada VISO    </td>
                        <td>Asignación Completada  </td>
                    </tr>
                    <tr>
                        <td>Control entrada universitaria</td>
                        <td>Asignación Completada  </td>
                    </tr>
                    <tr>
                        <td>Patrullaje feria de todos santos</td>
                        <td>
                            <button class="button inline_button">
                            Asignar personal
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Control primer convite</td>
                        <td>
                            <button class="button inline_button">
                            Asignar personal
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Patrullaje calvario</td>
                        <td>
                            <button class="button inline_button">
                            Asignar personal
                            </button>
                        </td>
                    </tr>
                </table>


            </div>
    </div>


</div>
@endsection

@section ('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection
