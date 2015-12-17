<?php $Bicicletas = new Bicicleta(); ?>
<?php $Estacion = new Estacion(); ?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!--Titulo-->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-fw fa-archive"></i> Inventario
                </h1>

                <h3> <i class="fa fa-fw fa-bicycle"></i> Bicicletas</h3>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-clock-o"></i> Hoy: <?= date('Y-m-d'); ?> &nbsp;
                        <button class="btn btn-xs btn-default" type="button" onclick="Inventario.acciones.refrescar()">
                            <i class="fa fa-refresh"></i></button>
                    </li>
                </ol>
            </div>
        </div>

        <!--Resumen-->
        <?php $Bicicletas->load->view('inventario/resumen', compact('Bicicletas')); ?>

        <!--Buscar-->
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-search"></i> Buscar
                    </li>
                </ol>
            </div>
        </div>

        <?php $estaciones = $Estacion->cargarEstaciones() ?>

        <!--Form buscar-->
        <div class="row">
            <div class="form-inline">
                <div class="form-group">
                    <!--Select Estacion-->
                    <div class="col-xs-3">
                        <label class="control-label" for="select_estacion_inventario">Estacion</label>
                    </div>
                    <div class="col-xs-4">
                        <select id="select_estacion_inventario" class="form-control form-group">
                            <option>Todas</option>
                            <?php foreach ($estaciones as $estacion) { ?>
                                <option
                                    value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!--Espacio-->
        <div class="row">
            <div class="col-xs-12">&nbsp;</div>
        </div>

        <div class="row">
            <div class="form-inline">
                <div class="form-group">
                    <!--Select Estacion-->
                    <div class="col-xs-3">
                        <label class="control-label" for="select_estacion_inventario">Estado</label>
                    </div>
                    <div class="col-xs-4">
                        <select id="select_estacion_inventario" class="form-control form-group">
                            <option>Todas</option>
                            <?php foreach ($estaciones as $estacion) { ?>
                                <option
                                    value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!--Espacio-->
        <div class="row">
            <div class="col-xs-12">&nbsp;</div>
        </div>

        <div class="row">
            <div class="form-inline">
               <div class="form-group">
                    <div class="col-xs-3">
                        <label class="control-label" for="codigo_bicicleta">C&oacute;digo</label>
                    </div>
                    <div class="col-xs-7">
                        <div class="form-group input-group">
                            <input type="text" class="form-control" id="codigo_bicicleta" maxlength="5">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Espacio-->
        <div class="row">
            <div class="col-xs-12">&nbsp;</div>
        </div>

        <?php $Bicicletas->load->view('inventario/listado', compact('Bicicletas')); ?>

        </div>
    </div>
</div>