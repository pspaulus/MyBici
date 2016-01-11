<?php $Estacion = new Estacion(); ?>

<!-- mensajes flotantes-->
<?php Escritorio::Mensaje('guardar_ok', 'estacion') ?>
<?php Escritorio::Mensaje('editar_ok', 'estacion') ?>
<?php Escritorio::Mensaje('error', 'estacion') ?>

<!-- Titulo -->
<div class="row" id="page_estacion">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-home"></i> Estaciones
            <a class="dedo" data-toggle="modal" data-target="#crearEstacion"> <i class="fa fa-plus-circle"></i> </a>
        </h1>
    </div>
</div>

<input type="hidden" value="<?= Escritorio::verificarInternet()?>" id="estacion_sin_internet">

<?php $Estacion->load->view('estacion/crear', compact('Estacion')); ?>

<div class="row">
    <!--Select Estacion-->
    <div class="form-group">
        <div class="agrupador">
            <div class="col-xs-10 col-sm-4 col-lg-3">
                <?php $estaciones = $Estacion->cargarEstaciones(); ?>
                <select id="select_estacion" class="form-control"
                        onchange="Estacion.acciones.cargarDatosEstacion()">
                    <?php foreach ($estaciones as $estacion) { ?>
                        <option
                            value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-xs-9 mensaje oculto">
                <label class="control-label" id="error_sin_estacion">&iexcl;No hay estaci&oacute;n!</label>
            </div>
        </div>

        <div class="col-xs-2">
            <!-- Button editar -->
            <button type="button" class="btn btn-warning" title="Editar Estaci&oacute;n"
                    id="btn_editar_estacion" onclick="Estacion.acciones.editar()"><i class="fa fa-edit"></i>
            </button>

            <!-- Button guardar -->
            <button type="button" class="btn btn-success" title="Actualizar Estaci&oacute;n"
                    id="btn_guardar_estacion" onclick="Estacion.acciones.guardarEditar();"><i class="fa fa-check"></i>
            </button>
            <script>
                Estacion.validaciones.botonGuardar('ocultar');
            </script>
        </div>
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