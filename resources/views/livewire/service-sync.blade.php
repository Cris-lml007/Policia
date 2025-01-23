<div>
    <button id="sync" class="button inline_button">
        Sincronizar servicios
        <span class="fas fa-sync"></span>
    </button>
</div>


@script
    <script>
        let btnSync = document.getElementById('sync');
        btnSync.addEventListener('click', () => {
            let timerInterval;
            let Swal = window.Swal;
            Swal.fire({
                title: "Sincronizando",
                html: "por favor espera a que termine la sincronización",
                timer: 0,
                didOpen: () => {
                    Swal.showLoading();
                    timerInterval = setInterval(() => {
                        if ($wire.message == 1) {
                            Swal.close();
                            Swal.fire({
                                'title': 'Finalizado',
                                'text': 'Sincronización completada exitosamente.',
                                'icon': 'success'

                            });
                            clearInterval(timerInterval);
                        } else if ($wire.message == -1) {
                            Swal.fire({
                                'title': 'Hubo un Error',
                                'text': 'No se pudo completar la sincronización.',
                                'icon': 'error'

                            });
                            clearInterval(timerInterval);
                        }
                    }, 1000);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
            $wire.dispatch('syncServices');
        });
    </script>
@endscript
