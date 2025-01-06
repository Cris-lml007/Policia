<div>
    <button id="onCamera" class="btn btn-primary"><i class="fa fa-camera"></i> Activar Camara</button>
    <div id="reader" width="500px" wire:ignore>
    </div>
    <button id="disableCamera" class="btn btn-secondary d-none"><i class="fa fa-camera"></i> Desactivar Camara</button>
</div>

@script
    <script type="module">
        document.addEventListener('livewire:initialized', () => {

            let html5QrCode = new window.Html5Qrcode("reader");
            let config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            };

            function closeCamera() {
                html5QrCode.stop().then((ignore) => {}).catch((err) => {});
                document.getElementById('onCamera').classList.remove('d-none');
                document.getElementById('disableCamera').classList.add('d-none');
            }

            function onScanSuccess(decodedText, decodedResult) {
                html5QrCode.stop().then((ignore) => {
                    Livewire.dispatch('Qr', {
                        qr: decodedText
                    });
                }).catch((err) => {});
            }

            function activeCamera() {
                document.getElementById('disableCamera').classList.remove('d-none');
                html5QrCode.start({
                    facingMode: "environment"
                }, config, onScanSuccess);
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
            document.getElementById('disableCamera').addEventListener('click',()=>{
                closeCamera();
            });
        });
    </script>
@endscript
