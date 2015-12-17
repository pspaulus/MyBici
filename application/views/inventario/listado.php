<?php $bicicletas_todas = $Bicicletas->cargarTodasBicicletas(); ?>

<!--Tabla-->
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>C&oacute;digo</th>
                    <th>Estaci&oacute;n</th>
                    <th>Estacionamiento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bicicletas_todas as $bicicleta) { ?>
                    <?php
                    $codigo_estacion = Estacion::getCodigoEstacion($bicicleta->PUESTO_ALQUILER_id);
                    $nombre_estacion = Estacion::getNombreEstacion($bicicleta->PUESTO_ALQUILER_id);
                    $estado_bicicleta = Bicicleta::getEstadoBicicleta($bicicleta->id);
                    $codigo_estacionamiento = Bicicleta::getEstacionamiento($bicicleta->id);
                    ?>
                    <tr>
                        <td><?= $codigo_estacion . $bicicleta->codigo ?></td>
                        <td><?= $codigo_estacion . ' - ' . $nombre_estacion ?></td>
                        <td><?= $codigo_estacion . $codigo_estacionamiento?></td>
                        <td><?= $estado_bicicleta ?></td>
                        <td>
                            <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                            <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>