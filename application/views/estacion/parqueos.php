<?php $Estacionamiento = new Estacionamiento(); ?>
<?php $Bicicleta = new Bicicleta(); ?>
<div class="col-xs-12">
    <h3>Lista de parqueos - <?= Estacion::getNombreEstacion($estacion_id) ?></h3>

    <div class="table-responsive">
        <table id="tabla_usuario" class="table table-hover">
            <thead>
            <tr>
                <th>Nro.</th>
                <th>Cod. Estaci&oacute;n</th>
                <th>Cod. Bicicleta</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <?php $estacionamientos = $Estacionamiento->cargarEstacionamientos($estacion_id, $estado); ?>
            <tbody>
            <?php $i = 1 ?>
            <?php foreach ($estacionamientos as $estacionamiento) { ?>
                <tr>
                    <td><strong><?= $i ?></strong></td>
                    <?php $i++ ?>
                    <td><?= $Estacion->getCodigoEstacion($estacion_id) . 'P' . $estacionamiento->codigo; ?></td>
                    <?php $bicicleta = $Bicicleta->cargarBicicleta($estacionamiento->BICICLETA_id); ?>
                    <?php $existe_bicicleta = ((bool)$bicicleta); ?>
                    <?php if ($existe_bicicleta) {
                        $bicicleta_estacion_codigo = $Bicicleta->getCodigoEstacionByBicicletaEstacionId($bicicleta->PUESTO_ALQUILER_id);
                    } ?>
                    <td><?= ($existe_bicicleta) ? $bicicleta_estacion_codigo . 'B' . $bicicleta->codigo : '-'; ?></td>
                    <td>
                        <?php //if ($existe_bicicleta) { ?>
                        <button class="btn btn-sm btn-default" type="button" title="Agregar Bicicleta"
                                data-toggle="modal" data-target="#agregarBicicleta_<?= $estacionamiento->id ?>"><i
                                class="fa fa-plus"></i></button>
                        <!--Modal Agregar-->
                        <?php $Estacionamiento->load->view('estacionamiento/agregar', compact('estacionamiento')); ?>

                        <? //} ?>
                        <?php // if ($existe_bicicleta) { ?>
                            <button class="btn btn-sm btn-danger" type="button" title="Quitar Bicicleta"
                                    data-toggle="modal" data-target="#quitarBicicleta_<?= $estacionamiento->id ?>"><i
                                    class="fa fa-minus"></i></button>

                            <!--Modal Eliminar-->
                            <?php $Estacionamiento->load->view('estacionamiento/quitar', compact('estacionamiento')); ?>

                        <? //} ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>