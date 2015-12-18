<?php
$Bicicletas = new Bicicleta();
if ($filtro == 'codigo') {
    $bicicletas_todas = $Bicicletas->cargarListaBicicletasPorCodigo($bicicleta_codigo);
} elseif ($filtro == 'estacion') {
    $bicicletas_todas = $Bicicletas->cargarListaBicicletasporEstacion($estacion_id, $estado_id);
}
?>

<h3>Lista de bicicletas</h3>

<!--Tabla-->
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>C&oacute;digo</th>
                    <th>Estaci&oacute;n</th>
                    <th>Estacionamiento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                <?php foreach ($bicicletas_todas as $bicicleta) { ?>
                    <?php
                    $codigo_estacion = Estacion::getCodigoEstacion($bicicleta->PUESTO_ALQUILER_id);
                    $nombre_estacion = Estacion::getNombreEstacion($bicicleta->PUESTO_ALQUILER_id);
                    $estado_bicicleta = Bicicleta::getEstadoBicicleta($bicicleta->id);
                    $codigo_estacionamiento = Bicicleta::getEstacionamiento($bicicleta->id);
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <?php $i++ ?>
                        <td><?= $codigo_estacion . $bicicleta->codigo ?></td>
                        <td><?= $codigo_estacion . ' - ' . $nombre_estacion ?></td>
                        <td><?= $codigo_estacion . $codigo_estacionamiento ?></td>
                        <td><?= $estado_bicicleta ?></td>
                        <td>
                            <?php if ($bicicleta->ESTADO_id  == 7) { //buena ?>
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
                            <?php }  ?>


                            <?php if ($bicicleta->ESTADO_id  == 8) { // danada ?>
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
                            <?php }  ?>


                            <?php if ($bicicleta->ESTADO_id  == 3) { // reparar ?>
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
                            <?php }  ?>

                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>