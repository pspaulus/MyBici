<?php /** @var Bicicleta $Bicicleta */ ?>
<?php /** @var Estacionamiento $Estacionamiento */ ?>

<div class="col-xs-12">
    <?php if (!empty($estacion_id)) { ?>
        <h3>Lista de Estacionamientos</h3>
    <?php } else { ?>
        <h3>Lista de Estacionamientos - <?= Estacion::getNombreEstacion($estacion_id) ?></h3>
    <?php } ?>
    <div class="table-responsive">
        <table id="tabla_usuario" class="table table-hover">
            <thead>
            <tr>
                <th>Nro.</th>
                <th>C&oacute;d. Estaci&oacute;n</th>
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

                <?php $estacionamiento_codigo = $Estacionamiento->generarCodigo($estacionamiento->id); ?>
                <?php $estacion_nombre = Estacion::getNombreEstacion($estacionamiento->PUESTO_ALQUILER_id); ?>
                <?php $bicicleta = $Bicicleta->cargarBicicleta($estacionamiento->BICICLETA_id); ?>
                <?php if ($bicicleta != null) {
                    $bicicleta_codigo = Bicicleta::generarCodigo($bicicleta->id);
                    $bicicleta_estado = Bicicleta::getEstadoBicicleta($bicicleta->id);
                    $codigo_bicicleta_mostrar = '<i class="fa fa-bicycle"></i> ' . $bicicleta_codigo .
                        ' - <small>' . $bicicleta_estado . '</small>';
                    $clase = $bicicleta->ESTADO_id;
                } else {
                    $codigo_bicicleta_mostrar = '-';
                    $clase = '';
                }

                if ($clase == 3) {
                    $clase = 'text-warning';
                } else if ($clase == 8) {
                    $clase = 'text-danger';
                }

                ?>
                <tr class="<?= $clase; ?>">
                    <td><strong><?= $i ?></strong></td> <?php $i++ ?>
                    <td><i class="fa fa-home"></i> <?= $estacion_nombre ?></td>
                    <td><i class="fa fa-product-hunt"></i> <?= $estacionamiento_codigo ?></td>
                    <td><?= $codigo_bicicleta_mostrar ?></td>
                    <td>
                        <?php if ($bicicleta == null) { ?>
                            <button class="btn btn-sm btn-primary" type="button" title="Estacionar Bicicleta"
                                    data-toggle="modal" data-target="#agregarBicicleta_<?= $estacionamiento->id ?>"><i
                                    class="fa fa-bicycle"></i>&nbsp;<i class="fa fa-sign-in"></i></button>

                            <!--Modal Agregar-->
                            <?php $Estacionamiento->load->view('estacionamiento/agregar', compact('estacionamiento'));
                        } else {
                            if ($bicicleta->ESTADO_id != 6 && $bicicleta->ESTADO_id != 9) { ?>
                                <button class="btn btn-sm btn-danger" type="button" title="Retirar Bicicleta"
                                        data-toggle="modal" data-target="#quitarBicicleta_<?= $estacionamiento->id ?>">
                                    <i class="fa fa-sign-out"></i>&nbsp;<i class="fa fa-bicycle"></i></button>

                                <!--Modal Eliminar-->
                                <?php $data['estacionamiento'] = $estacionamiento; ?>
                                <?php $data['bicicleta_codigo'] = $bicicleta_codigo; ?>
                                <?php $data['estacionamiento_codigo'] = $estacionamiento_codigo; ?>
                                <?php $Estacionamiento->load->view('estacionamiento/quitar', $data);
                            }
                        } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="tip text-center espacioAbajoFijo">
            <small>
                <a href="#listado_busqueda" class="dedo">Ir al inicio</a>
            </small>
        </div>
    </div>
</div>