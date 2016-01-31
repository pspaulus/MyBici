<?php $Estacion = new Estacion(); ?>

<!-- mensajes flotantes-->
<div class="mensajeFlotanteContenedor">
    <?php Escritorio::Mensaje('guardar_ok', 'estacion') ?>
    <?php Escritorio::Mensaje('editar_ok', 'estacion') ?>
    <?php Escritorio::Mensaje('error', 'estacion') ?>
</div>

<!-- Titulo -->
<div class="row" id="page_estacion">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-home"></i> Estaciones
            <span id="contendor_boton_crear"></span>
        </h1>
    </div>
</div>
<script>
    Estacion.index.cargarBotonCrear();
</script>


<input type="hidden" value="<?= Escritorio::verificarInternet() ?>" id="estacion_sin_internet">

<div id="contenedor_div_crear"></div>
<script>
    Estacion.index.cargarVistaCrear();
</script>


<div class="row">
    <!--Select Estacion-->
    <div class="form-group">

        <div class="col-xs-10 col-sm-4 col-lg-3">
            <div class="agrupador">
                <?php $estaciones = $Estacion->cargarEstaciones(); ?>
                <select id="select_estacion" class="form-control"
                        onchange="Estacion.acciones.cargarDatosEstacion()">
                    <?php foreach ($estaciones as $estacion) { ?>
                        <option
                            value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                    <?php } ?>
                </select>

                <div class="col-xs-12 mensaje oculto">
                    <label class="control-label" id="error_sin_estacion">&iexcl;No hay estaci&oacute;n!</label>
                </div>
            </div>
        </div>

        <div class="col-xs-2" id="contenedor_botones_editar"></div>
        <script>
            //se movio a despues de mostrar datos
            //Estacion.index.cargarBotonesEditar();
        </script>
    </div>
</div>

<!-- Subtitulo -->
<div class="row espacioArriba">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">
                <strong><i class="fa fa-list-alt"></i> Datos</strong>
            </li>
        </ol>
    </div>
</div>

<!-- Datos -->
<div class="row">
    <div class="col-xs-12">
        <div id="datos_estacion"></div>
    </div>
</div>

<script>
    Estacion.acciones.cargarDatosEstacion();
</script>