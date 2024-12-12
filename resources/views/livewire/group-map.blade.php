<div>
    <div wire:ignore id="map"></div>
</div>


@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script>
        var mark = L.marker([0, 0]);
        var map = L.map('map').setView([{{ $service->lat }}, {{ $service->long }}], 13);
        var marker = L.marker([{{ $service->lat }}, {{ $service->long }}]).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);
    </script>

    <script>
        var geofences = L.featureGroup().addTo(map); // Grupo para todas las geovallas
        var geofenceColors = {}; // Almacenar colores por grupo
        // Configurar el control de dibujo
        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: geofences,
                remove: false,
                edit: false
            },
            draw: {
                polyline: false,
                circle: false,
                rectangle: false,
                marker: false,
                circlemarker: false,
                polygon: false
            }
        });
        map.addControl(drawControl);

        // Crear una instancia del manejador de dibujo para polígonos
        var polygonDrawer = new L.Draw.Polygon(map, drawControl.options.draw.polygon);

        // Función para guardar la geovalla en el servidor
        function saveGeofenceToServer(groupId, coordinates) {
            console.log(`Guardando geovalla para el grupo ${groupId}:`, coordinates);
            return [groupId, coordinates];
        }

        // Función para eliminar la geovalla en el servidor
        function deleteGeofenceFromServer(groupId) {
            console.log(`Eliminando geovalla para el grupo ${groupId}`);
            // Implementa la lógica para eliminar la geovalla
        }

        // Generar un color aleatorio
        function getRandomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        }
    </script>
@endsection


@script
    <script>
        $wire.getGeofences();
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('loadGeofences', (geofencesData) => {
                if (geofencesData.length > 0) {
                    console.log("Geovallas cargadas:", geofencesData);

                    geofencesData[0].forEach(function(item) {
                        let geoData = JSON.parse(item['points']);
                        if (Array.isArray(geoData) && geoData.length > 0) {
                            let groupId = item['group_service_id'];
                            let color = geofenceColors[groupId] || getRandomColor();
                            let polygonPoints = geoData.map(point => [point.lat, point.lng]);
                            let polygon = L.polygon(polygonPoints, {
                                color: color,
                                fillColor: color,
                                fillOpacity: 0.5,
                            }).addTo(map);
                            polygon.groupId = groupId;

                            geofences.addLayer(polygon);
                        } else {
                            console.error("Formato inválido para los puntos de la geovalla:",
                                geoData);
                        }
                    });
                } else {
                    console.log("No hay geovallas para cargar.");
                }
            });

            // Manejar clics en "Definir"
            document.querySelectorAll('.define-geofence').forEach(function(button) {
                button.addEventListener('click', function() {
                    var groupId = this.dataset.groupId;
                    if (!geofenceColors[groupId]) {
                        geofenceColors[groupId] = getRandomColor();
                    }
                    var color = geofenceColors[groupId];
                    polygonDrawer.setOptions({
                        shapeOptions: {
                            color: color,
                            fillColor: color,
                            fillOpacity: 0.5
                        }
                    });
                    polygonDrawer.enable();
                    map.once('draw:created', function(event) {
                        var layer = event.layer;
                        layer.setStyle({
                            color: color, // Usar el color único
                            fillColor: color,
                            fillOpacity: 0.5
                        });
                        geofences.addLayer(layer);
                        layer.groupId = groupId; // Asociar la geovalla al grupo
                        document.getElementById(`geofence-status-${groupId}`).textContent =
                            "Definida";
                        document.querySelector(
                                `.define-geofence[data-group-id="${groupId}"]`)
                            .style.display = "none";
                        var colorIcon = document.getElementById(`geofence-color-${groupId}`)
                            .querySelector('i');
                        colorIcon.style.color = color;
                        document.querySelector(
                                `.delete-geofence[data-group-id="${groupId}"]`).style
                            .display = "inline";

                        // Opcional: Enviar datos al servidor
                        let dat = saveGeofenceToServer(groupId, layer.getLatLngs());
                        let coordinatesJson = JSON.stringify(dat[1]);
                        $wire.newGeofence(dat[0], coordinatesJson);
                    });
                });
            });

            // Manejar clics en "Eliminar"
            document.querySelectorAll('.delete-geofence').forEach(function(button) {
                button.addEventListener('click', function() {
                    var groupId = this.dataset.groupId;

                    // Buscar y eliminar la geovalla del mapa
                    geofences.eachLayer(function(layer) {
                        if (layer.groupId == groupId) {
                            geofences.removeLayer(layer);
                        }
                    });

                    // Actualizar la tabla
                    document.getElementById(`geofence-status-${groupId}`).textContent =
                        "Sin Definir";
                    var colorIcon = document.getElementById(`geofence-color-${groupId}`)
                        .querySelector('i');
                    colorIcon.style.color = "#FFFFFF";
                    document.querySelector(`.delete-geofence[data-group-id="${groupId}"]`).style
                        .display = "none";
                    document.querySelector(`.define-geofence[data-group-id="${groupId}"]`)
                        .style.display = "inline";

                    // Opcional: Notificar al servidor
                    deleteGeofenceFromServer(groupId);
                    $wire.destroyGeofence(groupId);
                });
            });
        });
    </script>
@endscript

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        #map {
            height: 380px;
        }
    </style>
@endsection
