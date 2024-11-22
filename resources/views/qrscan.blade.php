@extends('adminlte::page')

@section('content')
<div class="general fondo">
    <div style="width: 100%;margin-top: 10px;">
        <div class="container label">
            <h5 class="form_titulo subtitulo">Escanear QR</h5>
            <div>
                <button id="onCamera" class="btn btn-primary"><i class="fa fa-camera"></i> Activar Camara</button>
                <div id="reader" width="600px">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="module">
        let html5QrcodeScanner = new window.Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            });

        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.clear();
            try {
                let qrData = JSON.parse(decodedText);
                if (qrData.account === undefined || qrData.quantity === undefined || qrData.id === undefined)
                    return Swal.fire({
                        title: "Vaya...",
                        text: "Parece que este QR no es Valido",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Entiendo"
                    }).then((result) => {
                        window.location.href = "{{ route('dashboard.home') }}";
                    });
                document.getElementById('id').value = qrData.id;
                document.getElementById('account').value = qrData.account;
                document.getElementById('quantity').value = qrData.quantity;
                document.getElementById('bt').click();

            } catch (e) {
                return Swal.fire({
                    title: "Vaya...",
                    text: "Parece que este QR no es Valido",
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Entiendo"
                }).then((result) => {
                    window.location.href = "{{ route('dashboard.home') }}";
                });
            }
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        function activeCamera() {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        let btnCamera = document.getElementById('onCamera');
        btnCamera.addEventListener('click', () => {
        console.log("addad");
            btnCamera.classList.add('d-none');
            activeCamera();
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
