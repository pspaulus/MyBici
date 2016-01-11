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
                    <?php $estacionamiento_codigo = $Estacionamiento->generarCodigo($estacionamiento->id); ?>
                    <?php $bicicleta = $Bicicleta->cargarBicicleta($estacionamiento->BICICLETA_id); ?>
                    <?php if ($bicicleta != null){
                        $bicicleta_codigo = Bicicleta::generarCodigo($bicicleta->id);
                        $codigo_bicicleta_mostrar = '<i class="fa fa-bicycle"></i> ' . $bicicleta_codigo . ' - ' . Bicicleta::getEstadoBicicleta($bicicleta->id);
                    } else {
                        $codigo_bicicleta_mostrar =  '-';
                    }
                    ?>

                    <td><strong><?= $i ?></strong></td> <?php $i++ ?>
                    <td><i class="fa fa-product-hunt"></i> <?= $estacionamiento_codigo ?></td>
                    <td><?= $codigo_bicicleta_mostrar ?></td>
                    <td>
                        <?php if ($bicicleta == null) { ?>
                            <button class="btn btn-sm btn-primary" type="button" title="Estacionar Bicicleta"
                                    data-toggle="modal" data-target="#agregarBicicleta_<?= $estacionamiento->id ?>"><i
                                    class="fa fa-plus"></i>&nbsp;<i class="fa fa-bicycle"></i></button>

                            <!--Modal Agregar-->
                            <?php $Estacionamiento->load->view('estacionamiento/agregar', compact('estacionamiento'));
                        } else {
                            if ($bicicleta->ESTADO_id != 6 && $bicicleta->ESTADO_id != 9) { ?>
                                <button class="btn btn-sm btn-danger" type="button" title="Retirar Bicicleta"
                                        data-toggle="modal" data-target="#quitarBicicleta_<?= $estacionamiento->id ?>">
                                    <i class="fa fa-minus"></i>&nbsp;<i class="fa fa-bicycle"></i></button>

                                <!--Modal Eliminar-->
                                <?php $data['estacionamiento'] = $estacionamiento;?>
                                <?php $data['bicicleta_codigo'] = $bicicleta_codigo;?>
                                <?php $data['estacionamiento_codigo'] = $estacionamiento_codigo;?>
                                <?php $Estacionamiento->load->view('estacionamiento/quitar', $data);
                            }
                        } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="tip text-center">
            <small>
                <a href="#listado_busqueda" class="dedo">Ir al inicio</a>
            </small>
        </div>
    </div>
</div>