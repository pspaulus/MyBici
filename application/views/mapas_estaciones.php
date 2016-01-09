<!--Mapa-->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Estaciones</h3>
    </div>
    <div class="panel-body">
        <?php
        $Estacion = new Estacion();
        $estaciones = $Estacion->cargarEstaciones();

        foreach ($estaciones as $estacion) {
            if ($estacion != null) {
                echo '<div class="estacion oculto" data-nombre="' . $estacion->nombre . '" data-codigo="' . $estacion->codigo . '"
                               data-latitud="' . $estacion->latitud . '" data-longitud="' . $estacion->longitud . '">
                          </div>';
            }
        }
        ?>
        <div id="mapEstacionTodas" class="mapa"></div>
        <script>
            ver_mapa_todos("mapEstacionTodas");
        </script>
    </div>
</div>