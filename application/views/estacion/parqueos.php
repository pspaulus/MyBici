<?php $Estacionamiento = new Estacionamiento(); ?>
<?php $Bicicleta = new Bicicleta(); ?>
<div class="col-xs-12">
    <h3>Lista de parqueos - (Nombre del Estacionamiento)</h3>

    <div class="table-responsive">
        <table id="tabla_usuario" class="table table-hover">
            <thead>
            <tr>
                <th>N&uacute;mero</th>
                <th>Cod. Bicicleta</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <?php //todo-ps debe ser controler estacionamiento
            $estacionamientos = $Estacionamiento->cargarEstacionamientos($estacion_id, $estado); ?>
            <tbody>
            <?php foreach ($estacionamientos as $estacionamiento) { ?>
                <tr>
                    <td><?= $Estacion->getCodigoEstacion($estacion_id) . $estacionamiento->codigo; ?></td>
                    <?php  $bicicleta = $Bicicleta->cargarBicicleta($estacionamiento->BICICLETA_id); ?>
                    <td><?= ((bool)$bicicleta) ? $bicicleta->codigo : '-'; ?></td>
                    <td>
                        <button class="btn btn-sm btn-default" type="button" title="Agregar Bicicleta"><i
                                class="fa fa-plus"></i></button>
                        <button class="btn btn-sm btn-danger" type="button" title="Quitar Bicicleta"><i
                                class="fa fa-minus"></i></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>