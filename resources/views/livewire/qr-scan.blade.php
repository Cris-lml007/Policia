<div>
    <button id="onCamera" class="btn btn-primary"><i class="fa fa-camera"></i> Activar Camara</button>
    <div id="reader" width="500px" wire:ignore>
    </div>
</div>

@script
    <script type="module">
        document.addEventListener('livewire:initialized', () => {
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
                html5QrcodeScanner.clear();
                Livewire.dispatch('Qr', {
                    qr: decodedText
                });
            }

            function onScanFailure(error) {
                console.log("No se ha escaneado aún.");
            }

            function activeCamera() {
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }


            Livewire.on('message', () => {
                let Swal = window.Swal;
                Swal.fire({
                    title: ($wire.message == 1 ? 'Codigo Activado' : 'Hubo un Error'),
                    text: ($wire.message == 1 ? 'El Codigo Qr se Activo Correctamente.' :
                        'El Codigo Qr no es Valido.'),
                    icon: ($wire.message == 1 ? 'success' : 'error'),
                    confirmButtonText: 'Aceptar'
                });
            });

            let btnCamera = document.getElementById('onCamera');
            btnCamera.addEventListener('click', () => {
                console.log("Cámara activada.");
                btnCamera.classList.add('d-none');
                activeCamera();
            });
        });
    </script>
@endscript
