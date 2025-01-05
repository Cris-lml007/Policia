<div class="d-flex justify-content-center">
    <img style="width: 100%;" src="data:image/svg+xml;base64,{{ $token }}">
</div>

@script
    <script>
        let intervalId = setInterval(()=>{
            $wire.$refresh();
            if($wire.message == 1){
                let Swal = window.Swal;
                Swal.fire({
                    title: 'Codigo Activado',
                    text: 'El Codigo Qr se Activo Correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
                clearInterval(intervalId);
                $wire.$parent.canceledQr();
            }
        },1000);
        document.addEventListener('livewire:initialized', () => {

        });
    </script>
@endscript
