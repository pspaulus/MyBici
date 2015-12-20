<div class="container-fluid" id="editar_estacion">

    <!--Espacio-->
    <div class="row">
        <div class="col-lg-12">
            &nbsp;
        </div>
    </div>

    <!--Codigo-->
    <div class="row form-group">
        <div class="col-xs-2">
            <label for="Descripcion">C&oacute;digo</label>
        </div>
        <div class="agrupador">
            <div class="col-xs-2">
                <input class="form-control" id="editar_estacion_codigo" type="text" maxlength="1"
                       placeholder="_" value="<?= $estacion_actual->codigo ?>"
                       onkeypress="return Escritorio.Validaciones.soloLetras(event)"
                       onkeyup="Estacion.label.codigo()" disabled>
            </div>
            <div class="col-xs-4 oculto mensaje">
                <label class="control-label" id="error_codigo_parqueos">&iexcl;Ingrese el c&oacute;digo!</label>
            </div>

            <!-- Button editar Estacion-->
            <div class="form-group">
                <button type="button" class="btn btn-warning" title="Editar Estaci&oacute;n"
                        id="btn_editar_estacion" onclick="Estacion.acciones.editar()"><i class="fa fa-edit"></i>
                </button>

                <!-- Button guardar Estacion-->
                <button type="button" class="btn btn-success" title="Actualizar Estaci&oacute;n"
                        id="btn_guardar_estacion" onclick="Estacion.acciones.guardarEditar();"><i class="fa fa-check"></i></button>
                <script>
                    Estacion.validaciones.botonGuardar('ocultar');
                </script>
            </div>
        </div>
    </div>

    <!--Nombre-->
    <div class="row form-group">
        <div class="col-xs-2">
            <label for="Descripcion">Nombre</label>
        </div>
        <div class="agrupador">
            <div class="col-xs-6">
                <input class="form-control" id="editar_estacion_nombre" type="text" maxlength="40"
                       placeholder="Ingrese un nombre" value="<?= $estacion_actual->nombre ?>"
                       onkeyup="Estacion.label.nombre()" disabled>
            </div>
            <div class=" row col-xs-4 col-xs-offset-3 oculto mensaje">
                <label class="control-label" id="error_nombre_parqueos">&iexcl;Ingrese el
                    nombre!</label>
            </div>
        </div>
    </div>

    <!--Parqueos-->
    <div class="row form-group">
        <div class="col-xs-2">
            <label for="Descripcion"> Total de Parqueos</label>
        </div>
        <div class="agrupador">
            <div class="col-xs-2">
                <input class="form-control" id="numero_estaciones" type="text"
                       maxlength="2" value="<?= Estacionamiento::contarNumeroEstacionamiento($estacion_actual->id) ?>"
                       onkeypress="return Escritorio.Validaciones.soloNumeros(event)"
                       onkeyup="Estacionamiento.label.cantidad();" disabled>
            </div>
            <div class="col-xs-2 mensaje oculto">
                <label class="control-label" id="error_cantidad_parqueos">&iexcl;Error de
                    cantidad!</label>
            </div>

            <!-- Button trigger modal crear estacionamiento -->
            <button type="button" class="btn btn-primary" title="Agrgar estacionamientos" data-toggle="modal"
                    id="btn_crear_estacionamiento" data-target="#crear_estacionamiento" disabled><i
                    class="fa fa-plus"></i></button>

            <!-- Modal Agregar -->
            <?php $Estacion->load->view('estacionamiento/crear'); ?>

        </div>
    </div>


    <div class="row form-group">
        <div class="col-xs-2"></div>
        <div class="agrupador">
            <div class="col-xs-2"></div>
            <div class="col-xs-2 mensaje oculto">

            </div>
        </div>
    </div>

    <!--Mapa-->
    <div class="col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Ubicaci&oacute;n</h3>
            </div>
            <div class="panel-body">
                <a href="https://www.google.com.ec/maps/@<?= $estacion_actual->longitud ?>,<?= $estacion_actual->latitud ?>,21z"
                   target="_blank">https://www.google.com.ec/maps/@<?= $estacion_actual->longitud ?>
                    ,<?= $estacion_actual->latitud ?>,21z</a>

                <!--<iframe src="https://www.google.com.ec/maps/@-2.1521429,-79.9528856,21z"></iframe>-->
            </div>
        </div>
    </div>

</div>


