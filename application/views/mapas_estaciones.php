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

        </div>
    </div>
</div>