<div class="col-xs-12">
    <!-- mensajes flotantes-->
    <?php Escritorio::Mensaje('guardar_ok', 'estacionamiento') ?>
    <?php Escritorio::Mensaje('eliminar_ok', 'estacionamiento') ?>
    <?php Escritorio::Mensaje('error', 'estacionamiento') ?>
</div>

<!-- Titulo -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-product-hunt"></i> Estacionamientos
        </h1>
    </div>
</div>

<!-- Subtitulo -->
<div class="row" id="listado_busqueda">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo2">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo2'))">
                    <i class="fa fa-search"></i> Buscar
                </a>
            </li>
        </ol>
    </div>
</div>


<div id="contenido_buscar">

    <!--Form buscar-->
    <div class="row">
        <div class="form-inline">
            <div class="col-xs-12">

                <!--Select Estacion-->
                <div class="form-group espacio">
                    <label class="control-label" for="select_estacion">Estaci&oacute;n</label>

                    <?php $estaciones = $Estacion->cargarEstaciones() ?>
                    <select id="select_estacion" class="form-control">
                        <option value="-1">Todas</option>
                        <?php foreach ($estaciones as $estacion) { ?>
                            <option
                                value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                        <?php } ?>
                    </select>

                    <div class="agrupador">
                        <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                            <label class="control-label" id="error_sin_estacion">&iexcl;No hay estaci&oacute;n!</label>
                        </div>
                    </div>
                </div>

                <!--Select Estado Parqueo-->
                <div class="form-group espacio busqueda">
                    <label class="control-label" for="filtro_estado_estacionamiento">Estado</label>

                    <?php $estacionamiento_estados = Estado::getEstadoEstacionamiento(); ?>
                    <select class="form-control" id="filtro_estado_estacionamiento">
                        <option value="-1">Todos</option>
                        <?php foreach ($estacionamiento_estados as $estacionamiento_estado) { ?>
                            <option value="<?= $estacionamiento_estado->id ?>"><?= $estacionamiento_estado->descripcion ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Button buscar lista parqueo -->
                <div class="form-group espacio busqueda">
                    <button class="btn btn-primary" type="button" onclick="Estacionamiento.acciones.cargarListaEstacionamientos()">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!--Espacio-->
    <div class="row">
        <div class="col-xs-12">&nbsp;</div>
    </div>
</div>

<div class="row">
    <div id="listado_estacionamientos"></div>
</div>

<script>
    Estacionamiento.acciones.cargarListaEstacionamientos();
</script>