<?php $Estacionamiento = new Estacionamiento(); ?>
<?php $Bicicleta = new Bicicleta(); ?>
<div class="col-xs-12">
    <h3>Lista de Estacionamiento - <?= Estacion::getNombreEstacion($estacion_id) ?></h3>

    <div class="table-responsive">
        <table id="tabla_usuario" class="table table-hover">
            <thead>
            <tr>
                <th>Nro.</th>
                <th>C&oacute;d. Estacionamiento</th>
                <th>C&oacute;d. Bicicleta - Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php $estacionamientos = $Estacionamiento->cargarEstacionamientos($estacion_id, $estado); ?>
            <?php $i = 1 ?>

            <?php if (count($estacionamientos) == 0) $Estacionamiento->load->view('sin_datos') ?>

            <?php foreach ($estacionamientos as $estacionamiento) { ?>
                <tr>
                    <td><strong><?= $i ?></strong></td>
                    <?php $i++ ?>
                    <td><i class="fa fa-map-pin"></i> <?= $Estacion->getCodigoEstacion($estacion_id) . 'P' . $estacionamiento->codigo; ?></td>
                    <?php $bicicleta = $Bicicleta->cargarBicicleta($estacionamiento->BICICLETA_id); ?>
                    <?php if ($bicicleta != null) {
                        $bicicleta_estacion_codigo = $Bicicleta->getCodigoEstacionByBicicletaEstacionId($bicicleta->PUESTO_ALQUILER_id);
                        $codigo_para_mostrar = '<i class="fa fa-bicycle"></i> '. $bicicleta_estacion_codigo . 'B' . $bicicleta->codigo . ' - ' . Bicicleta::getEstadoBicicleta($bicicleta->id);
                    } else {
                        $codigo_para_mostrar = '-';
                    } ?>
                    <td>  <?= $codigo_para_mostrar ?></td>
                    <td>
                        <?php if ($bicicleta == null) { ?>
                            <button class="btn btn-sm btn-primary" type="button" title="Estacionar Bicicleta"
                                    data-toggle="modal" data-target="#agregarBicicleta_<?= $estacionamiento->id ?>"><i
                                    class="fa fa-plus"></i></button>
                            <!--Modal Agregar-->
                            <?php $Estacionamiento->load->view('estacionamiento/agregar', compact('estacionamiento'));
                        } else {
                            if ($bicicleta->ESTADO_id != 6 && $bicicleta->ESTADO_id != 9) { ?>
                                <button class="btn btn-sm btn-danger" type="button" title="Quitar Bicicleta"
                                        data-toggle="modal" data-target="#quitarBicicleta_<?= $estacionamiento->id ?>">
                                    <i class="fa fa-minus"></i></button>

                                <!--Modal Eliminar-->
                                <?php $Estacionamiento->load->view('estacionamiento/quitar', compact('estacionamiento'));
                            }
                        } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="tip text-center">
            <small>
                <a href="#listado_busqueda"class="dedo">Ir al inicio</a>
            </small>
        </div>
    </div>
</div>