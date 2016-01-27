<?php $Bicicletas = new Bicicleta(); ?>
<?php $Estacion = new Estacion(); ?>
<?php $Estado = new Estado(); ?>
<?php $Tipo = new Tipo(); ?>

<!-- mensajes flotantes-->
<div class="mensajeFlotanteContenedor">
    <?php Escritorio::Mensaje('guardar_ok', 'bicicleta') ?>
    <?php Escritorio::Mensaje('editar_ok', 'bicicleta') ?>
    <?php Escritorio::Mensaje('error', 'bicicleta') ?>
</div>

<!--Titulo-->
<div class="row" id="page_inventario">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-bicycle"></i> Inventario de Bicicletas
            <span id="contendor_boton_crear"></span>
            <small class="pull-right" id="total_invetario" style="padding-top: 10px">
                Total: <?= $Bicicletas->contarBicicletas(); ?>
            </small>
        </h1>
    </div>
</div>
<script>
    Bicicleta.index.cargarBotonCrear();
</script>


<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#resumen_inventario'), $('#titulo'))">
                    <i class="fa fa-clock-o"></i> Tablero de Estados &nbsp;
                </a>
                &nbsp;
                <?php $estaciones = $Estacion->cargarEstaciones(); ?>
                <select id="select_estacion_inventario" onchange="Bicicleta.acciones.RecargarResumen();">
                    <option value="-1">Estaci&oacute;n Todas</option>
                    <?php foreach ($estaciones as $estacion) { ?>
                        <option
                            value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                    <?php } ?>
                </select>
                &nbsp;
                <button class="btn btn-xs btn-default" type="button" title="Refrescar"
                        onclick="Bicicleta.acciones.RecargarResumen();">
                    <i class="fa fa-refresh">&nbsp</i></button>
            </li>
        </ol>
    </div>
</div>

<!--Resumen-->
<div id="resumen_inventario"></div>
<script>
    Bicicleta.acciones.RecargarResumen();
</script>

<!-- Modal Agregar bicicleta -->
<?php $Bicicletas->load->view('inventario/agregar', compact('Bicicletas', 'Estacion', 'Estado', 'Tipo')); ?>

<!--Buscar-->
<div class="row" id="listado_busqueda">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo3">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo3'))">
                    <i class="fa fa-search"></i> Buscar por:
                </a>
                &nbsp;
                <label class="radio-inline">
                    <input type="radio" name="tipo_busqueda" id="busqueda_por_codigo"
                           onclick="Bicicleta.acciones.cambioLista('unidad');
                                    $('#por_bicicleta').removeClass('oculto');
                                    $('#por_estacion').addClass('oculto');" checked> C&oacute;digo
                </label>
                <label class="radio-inline">
                    <input type="radio" name="tipo_busqueda" id="busqueda_por_estado"
                           onclick="Bicicleta.acciones.cambioLista('lote');
                                    $('#por_estacion').removeClass('oculto');
                                    $('#por_bicicleta').addClass('oculto');""> Estaci&oacute;n
                </label>
            </li>
        </ol>
    </div>
</div>
<input type="hidden" value="unidad" id="como_listo">

<div id="contenido_buscar">

    <!--Por bicicleta-->
    <div class="" id="por_bicicleta">
        <div class="row">
            <div class="form-inline">

                <div class="form-group">
                    <!--Codigo-->
                    <div class="col-xs-2">
                        <label class="control-label" for="codigo_bicicleta"
                               style="padding-top:10px">C&oacute;digo</label>
                    </div>
                    <div class="col-xs-6 col-sm-6 espacio">
                        <div class="agrupador">
                            <input type="text" class="form-control" id="codigo_bicicleta" maxlength="6"
                                   placeholder="GB1"
                                   onkeyup="Estacion.mensajes.oculta($('#error_formato_codigo'));
                                                Estacion.mensajes.oculta($('#error_vacio_codigo'));
                                                Bicicleta.acciones.pressEnterUnidad(event)">

                            <div class="mensaje oculto">
                                <label class="control-label " id="error_formato_codigo">&iexcl;Error de formato
                                    de c&oacute;digo!</label>
                            </div>
                            <div class="mensaje oculto">
                                <label class="control-label " id="error_vacio_codigo">&iexcl;Ingrese
                                    c&oacute;digo!</label>
                            </div>
                        </div>
                    </div>

                    <!--Boton buscar-->
                    <div class="col-xs-3 col-sm-2">
                        <button class="btn btn-primary" type="button"
                                onclick="Bicicleta.acciones.cargarListaBicicletasPorCodigo()"><i
                                class="fa fa-search"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Por Estacion-->
    <div class="oculto" id="por_estacion">
        <div class="row">
            <div class="form-inline">
                <div class="col-sm-12">

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

    <!--Espacio-->
    <div class="row">
        <div class="col-sm-12">&nbsp;</div>
    </div>
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
                        <th class="oculto">Tipo</th>
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
