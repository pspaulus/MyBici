<!--Mapa-->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Estaciones
            <button class="btn btn-xs btn-default" type="button"
                onclick="Escritorio.Acciones.refrescar()"><i class="fa fa-refresh"></i></button>
        </h3>
    </div>
    <div class="panel-body">
        <?php
        $Estacion = new Estacion();
        $estaciones = $Estacion->cargarEstaciones();

        foreach ($estaciones as $estacion) {
            if ($estacion != null) {
                $bicicletas_disponibles = Estacionamiento::contarBicicletasDisponiblesByEstacion($estacion->id);
                $bicicletas_total = Bicicleta::contarBicicletasTodasByEstacion($estacion->id);
                $parqueos_disponibles = Estacionamiento::contarEstacionamientoDisponiblesByEstacion($estacion->id);
                $parqueos_total = Estacionamiento::contarEstacionamientoTodosByEstacion($estacion->id);

                echo '<div class="estacion oculto" ' .
                            'data-nombre="' . $estacion->nombre . '" data-codigo="' . $estacion->codigo . '"
                             data-latitud="' . $estacion->latitud . '" data-longitud="' . $estacion->longitud . '"
                             data-parqueos_disponibles="' . $parqueos_disponibles . '" data-bicicletas_disponibles="' . $bicicletas_disponibles . '"
                             data-bicicletas_total="' . $bicicletas_total. '" data-parqueos_total="' . $parqueos_total . '"
                             >
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