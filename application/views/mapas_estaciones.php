<!--Mapa-->
<div class="col-xs-12 ">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Estaciones</h3>
        </div>
        <div class="panel-body">
            <div id="GoogleMapAll" class="mapa"></div>
            <?php
            $Estacion = new Estacion();
            $estaciones = $Estacion->cargarEstaciones();

            foreach ($estaciones as $estacion) {
                if ($estacion != null) {
                    echo '<div id="' . $estacion->nombre . '" class="mapas_id">
                                                    <div id=' . $estacion->latitud . '></div>
                                                    <div id=' . $estacion->longitud . '></div>
                                              </div>';
                }
            }
            ?>
            <script>

                var map = '';
                var marker = [];

                    var latlng = new google.maps.LatLng(-1, -1);

                    var myOptions = {
                        zoom: z,
                        center: latlng,
                        zoomControl: true,
                        mapTypeControl: false,
                        streetViewControl: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    var map = new google.maps.Map(document.getElementById("GoogleMapAll"), myOptions);

                    var marker = new google.maps.Marker({
                        position: latlng
                    });

                    marker.setMap(map);

            </script>
        </div>
    </div>
</div>