@extends('adminlte::page')

@section('content')
    <div class="general fondo">
        <div style="width: 100%;margin-top: 10px;">
            <div class="container label">
                <h5 class="form_titulo subtitulo">Escanear QR</h5>
                <div id="message"></div>
                <div>
                    <button id="onCamera" class="btn btn-primary"><i class="fa fa-camera"></i> Activar Camara</button>
                    <div id="reader" width="500px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="module">
        let message = document.getElementById("message");
        let html5QrcodeScanner = new window.Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            });

        function closeCamera() {
            html5QrcodeScanner.clear();
            document.getElementById('onCamera').classList.remove('d-none');
        }

        function onScanSuccess(decodedText, decodedResult) {
            try {

                fetch('/dashboard/mark', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Incluye el token CSRF de Laravel
                        },
                        body: JSON.stringify({
                            qrData: decodedText
                        })
                    }).then(response => {
                        // Asegúrate de que la respuesta sea OK (status 200)
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }

                        // Convertir la respuesta a JSON
                        return response.json();
                    })
                    .then(json => {
                        if (json) {
                            closeCamera();
                            message.innerHTML = "<div class='alert alert-success ' role='alert '>Su asistencia fue registrada</div>"
                        } else {
                            message.innerHTML = "<div class='alert alert-wargning ' role='alert '>El usuario no es el adecuado o ya marco su asistencia</div>"
                        }

                    })
                    .catch(error => {
                        console.error("Error durante la solicitud:", error);
                        alert("Hubo un error al procesar la solicitud");
                    });
            } catch (e) {
                // Si el QR no contiene un JSON válido
                console.error("Error al parsear el JSON del QR:", e);
                alert("El QR no contiene datos válidos.");
            }

        }

        function onScanFailure(error) {
            console.log("no scanea aun");
        }

        function activeCamera() {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        let btnCamera = document.getElementById('onCamera');
        btnCamera.addEventListener('click', () => {
            console.log("camera activa");
            btnCamera.classList.add('d-none');
            activeCamera();
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
