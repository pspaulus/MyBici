<?php $Estacion = new Estacion(); ?>

<!-- mensajes flotantes-->
<?php Escritorio::Mensaje('guardar_ok', 'estacion') ?>
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

<?php $Estacion->load->view('estacion/crear', compact('Estacion')); ?>

<script>
    //Estacion.acciones.cargarDatosEstacion();
</script>




<!-- Tabs -->
<div class="row">
    <div class="col-xs-12">

        <!-- Tab control -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#parqueos" data-toggle="tab" role="tab"
                   onclick="Estacion.acciones.busqueda('mostrar');">Estacionamientos</a>
            </li>
            <li role="presentation">
                <a href="#datos_estacion" data-toggle="tab" role="tab" id="mapTab"
                   onclick="Estacion.acciones.busqueda('ocultar');">Estaciones</a>
            </li>
        </ul>

        <!-- Tab panels -->
        <div id="" class="tab-content tab-contenido">

            <!-- tab parqueos -->
            <div role="tabpanel" class="tab-pane fade in active" id="parqueos">

                <!--Espacio-->
                <div class="row">
                    <div class="col-xs-12">&nbsp;</div>
                </div>


            </div>

            <div role="tabpanel" class="tab-pane fade" id="datos_estacion">

            </div>
        </div>

    </div>
</div>

<script>
    if ($('#select_estacion').val() != null) {
       // Estacionamiento.acciones.cargarListaParqueos()
    }
</script>