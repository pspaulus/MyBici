<?php $Bicicletas = new Bicicleta(); ?>
<?php $Estacion = new Estacion(); ?>
<?php $Estado = new Estado(); ?>
<?php $Tipo = new Tipo(); ?>

<!--Titulo-->
<div class="row" id="page_inventario">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-bicycle"></i> Inventario de Bicicletas
            <small> Total: <?= $Bicicletas->contarBicicletas(); ?></small>
        </h1>
    </div>
</div>

<div class="row" id="page_inventario">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_estados'), $('#titulo'))">
                    <i class="fa fa-clock-o"></i> Estados &nbsp;
                </a>
                <button class="btn btn-xs btn-default" type="button" title="Refrescar"
                        onclick="Inventario.acciones.refrescar();">
                    <i class="fa fa-refresh"></i></button>
            </li>
        </ol>
    </div>
</div>


<div id="contenido_estados">
    <!--Resumen-->
    <?php $Bicicletas->load->view('inventario/resumen', compact('Bicicletas')); ?>
</div>

<!--Agregar-->
<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo2">
                <a class="dedo" data-toggle="modal" data-target="#agregarBicicleta">
                    <i class="fa fa-plus-circle"></i> Agregar
                </a>
            </li>
        </ol>
    </div>
</div>

<!-- Modal Agregar bicicleta -->
<?php $Bicicletas->load->view('inventario/agregar', compact('Bicicletas', 'Estacion', 'Estado', 'Tipo')); ?>

<!--Buscar-->
<div class="row" id="listado_busqueda">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo3">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo3'))">
                    <i class="fa fa-search"></i> Buscar
                </a>
            </li>
        </ol>
    </div>
</div>


<div id="contenido_buscar">
    <!-- Tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#por_bicicleta" data-toggle="tab" role="tab">Por C&oacute;digo</a>
        </li>
        <li role="presentation">
            <a href="#por_estacion" data-toggle="tab" role="tab">Por Estaci&oacute;n</a>
        </li>
    </ul>

    <!-- Tab panels -->
    <div id="" class="tab-content tab-contenido">

        <!--Por bicicleta-->
        <div role="tabpanel" class="tab-pane fade in active" id="por_bicicleta">

            <!--Espacio-->
            <div class="row">
                <div class="col-xs-12">&nbsp;</div>
            </div>

            <div class="row">
                <div class="form-inline">
                    <div class="col-xs-12">

                        <!--Codigo-->
                        <div class="form-group espacio">
                            <label class="control-label" for="codigo_bicicleta">C&oacute;digo</label>
                            <input type="text" class="form-control" id="codigo_bicicleta" maxlength="6"
                                   placeholder="GB1" onkeyup="Bicicleta.acciones.validarFormatoCodigo();">

                            <div class="mensaje oculto">
                                <label class="control-label " id="error_formato_codigo">&iexcl;Error de formato
                                    de
                                    codigo!</label>
                            </div>
                        </div>


                        <!--Boton buscar-->
                        <div class="form-group">
                            <button class="btn btn-primary" type="button"
                                    onclick="Bicicleta.acciones.cargarListaBicicletasPorCodigo()"><i
                                    class="fa fa-search"></i></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--Por Estacion-->
        <div role="tabpanel" class="tab-pane fade" id="por_estacion">

            <!--Espacio-->
            <div class="row">
                <div class="col-xs-12">&nbsp;</div>
            </div>

            <div class="row">
                <div class="form-inline">
                    <div class="col-xs-12">

                        <!--Select Estacion-->
                        <div class="form-group espacio">
                            <?php $estaciones = $Estacion->cargarEstaciones() ?>
                            <label class="control-label"
                                   for="select_estacion_inventario">Estaci&oacute;n</label>
                            <select id="select_estacion_inventario" class="form-control">
                                <option value="-1">Todas</option>
                                <?php foreach ($estaciones as $estacion) { ?>
                                    <option
                                        value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!--Select Estado-->
                        <div class="form-group espacio">
                            <?php $estados_bicicletas = $Estado->getEstadoBicicletas(); ?>
                            <label class="control-label" for="select_estado_inventario">Estado</label>
                            <select id="select_estado_inventario" class="form-control">
                                <option value="-1">Todas</option>
                                <?php foreach ($estados_bicicletas as $estado) { ?>
                                    <option
                                        value="<?= $estado->id ?>"><?= $estado->descripcion ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!--Boton buscar-->
                        <div class="form-group">
                            <button class="btn btn-primary" type="button"
                                    onclick="Bicicleta.acciones.cargarListaBicicletasPorEstacion()"><i
                                    class="fa fa-search"></i></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Espacio-->
    <div class="row">
        <div class="col-xs-12">&nbsp;</div>
    </div>

    <div id="listado_bicicletas">
        <h3>Lista de bicicletas</h3>

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
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>