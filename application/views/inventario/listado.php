<?php
$Bicicletas = new Bicicleta();
if ($filtro == 'codigo') {
    $bicicletas_todas = $Bicicletas->cargarListaBicicletasPorCodigo($bicicleta_codigo);
} elseif ($filtro == 'estacion') {
    $bicicletas_todas = $Bicicletas->cargarListaBicicletasporEstacion($estacion_id, $estado_id);
}
?>

<h3>Lista de bicicletas
    <small> Total: <?= count($bicicletas_todas); ?></small>
</h3>

<!--Tabla-->
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>C&oacute;d. Bicicleta</th>
                    <th>Tipo</th>
                    <th>Estaci&oacute;n Propietaria</th>
                    <th>Estacionamiento Actual</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($bicicletas_todas) == 0) $Bicicletas->load->view('sin_datos') ?>

                <?php if ($bicicletas_todas != null) { ?>
                    <?php $i = 1 ?>

                    <?php foreach ($bicicletas_todas as $bicicleta) { ?>
                        <?php
                        $codigo_estacion = Estacion::getCodigoEstacion($bicicleta->PUESTO_ALQUILER_id);
                        $nombre_estacion_propietaria = Estacion::getNombreEstacion($bicicleta->PUESTO_ALQUILER_id);
                        $estado_bicicleta = Bicicleta::getEstadoBicicleta($bicicleta->id);
                        $estacionamiento_secuencia = Bicicleta::getEstacionamiento($bicicleta->id);
                        $estacionamiento_estacion_codigo = Bicicleta::getEstacionamientoEstacionCodigo($bicicleta->id);
                        $tipo_bibicleta = Bicicleta::getTipo($bicicleta->TIPO_id);
                        $estacionamiento_codigo = ($estacionamiento_secuencia != null) ? $estacionamiento_estacion_codigo . 'P' . $estacionamiento_secuencia : '-';
                        $estacionamiento_nombre = Estacion::getEstacionNombreByCodigo($estacionamiento_estacion_codigo);
                        $estacionamiento_acual =  ($estacionamiento_nombre != null) ? '<i class="fa fa-fw fa-home"></i> '. $estacionamiento_nombre.' - <i class="fa fa-product-hunt"></i> '.$estacionamiento_codigo: '-';
                        ?>
                        <tr>
                            <td><strong><?= $i ?></strong></td>
                            <?php $i++ ?>
                            <td><i class="fa fa-bicycle"></i> <?= $codigo_estacion . 'B' . $bicicleta->codigo ?></td>
                            <td><?= $tipo_bibicleta ?></td>
                            <td><?= $nombre_estacion_propietaria ?></td>
                            <td><?= $estacionamiento_acual ?></td>


                            <td><?= $estado_bicicleta ?></td>
                            <td>
                                <?php if ($bicicleta->ESTADO_id == 7) { //buena ?>
                                    <button class="btn btn-sm btn-warning" type="button" title="Enviar a Reparar"
                                            data-toggle="modal"
                                            data-target="#marcarEstadoReparar_<?= $bicicleta->id ?>"><i
                                            class="fa fa-wrench"></i></button>

                                    <button class="btn btn-sm btn-danger" type="button" title="Marcar Da&ntilde;ada"
                                            data-toggle="modal"
                                            data-target="#marcarEstadoDanada_<?= $bicicleta->id ?>"><i
                                            class="fa fa-close"></i>
                                    </button>
                                    <!--Modal marcar Dañada-->
                                    <?php $Bicicletas->load->view('inventario/danada', compact('bicicleta')); ?>

                                    <!--modal enviar a taller -->
                                    <?php $Bicicletas->load->view('inventario/reparar', compact('bicicleta')); ?>
                                <?php } ?>


                                <?php if ($bicicleta->ESTADO_id == 8) { // danada ?>
                                    <button class="btn btn-sm btn-warning" type="button" title="Enviar a Reparar"
                                            data-toggle="modal"
                                            data-target="#marcarEstadoReparar_<?= $bicicleta->id ?>"><i
                                            class="fa fa-wrench"></i></button>
                                    <button class="btn btn-sm btn-success" type="button" title="Marcar Buena"
                                            data-toggle="modal"
                                            data-target="#marcarEstadoBuena_<?= $bicicleta->id ?>"><i
                                            class="fa fa-check"></i></button>
                                    <!--modal enviar a taller -->
                                    <?php $Bicicletas->load->view('inventario/reparar', compact('bicicleta')); ?>

                                    <!--modal marca buena -->
                                    <?php $Bicicletas->load->view('inventario/buena', compact('bicicleta')); ?>
                                <?php } ?>


                                <?php if ($bicicleta->ESTADO_id == 3) { // reparar ?>
                                    <button class="btn btn-sm btn-danger" type="button" title="Marcar Da&ntilde;ada"
                                            data-toggle="modal"
                                            data-target="#marcarEstadoDanada_<?= $bicicleta->id ?>"><i
                                            class="fa fa-close"></i>
                                    </button>

                                    <button class="btn btn-sm btn-success" type="button" title="Marcar Buena"
                                            data-toggle="modal"
                                            data-target="#marcarEstadoBuena_<?= $bicicleta->id ?>"><i
                                            class="fa fa-check"></i></button>

                                    <!--Modal marcar Dañada-->
                                    <?php $Bicicletas->load->view('inventario/danada', compact('bicicleta')); ?>

                                    <!--modal marca buena -->
                                    <?php $Bicicletas->load->view('inventario/buena', compact('bicicleta')); ?>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
            <div class="tip text-center">
                <small>
                    <a href="#listado_busqueda">Ir al inicio</a>
                </small>
            </div>
        </div>
    </div>