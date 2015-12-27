<div class="container-fluid" id="editar_estacion">

    <!--Espacio-->
    <div class="row">
        <div class="col-lg-12">
            &nbsp;
        </div>
    </div>

    <div class="row form-group">

        <div class="agrupador">
            <!--Codigo-->
            <div class="col-xs-2">
                <label for="editar_estacion_codigo">C&oacute;digo</label>
            </div>

            <div class="col-xs-2">
                <input class="form-control" id="editar_estacion_codigo" type="text" maxlength="1"
                       placeholder="_" value="<?= $estacion_actual->codigo ?>"
                       onkeypress="return Escritorio.Validaciones.soloLetras(event)"
                       onkeyup="Estacion.mensajes.oculta($('#error_editar_codigo_estacion'));" disabled>

                <div class="oculto mensaje">
                    <label class="control-label" id="error_editar_codigo_estacion">&iexcl;Ingrese un
                        c&oacute;digo!</label>
                </div>
            </div>
        </div>

        <div class="col-xs-4 text-right">
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


    <div class="row form-group">
        <!--Nombre-->
        <div class="col-xs-2">
            <label for="editar_estacion_nombre">Nombre</label>
        </div>

        <div class="agrupador">
            <div class="col-xs-6">
                <input class="form-control" id="editar_estacion_nombre" type="text" maxlength="40"
                       placeholder="Ingrese un nombre" value="<?= $estacion_actual->nombre ?>"
                       onkeyup="Estacion.mensajes.oculta($('#error_edita_nombre_estacion'));" disabled>
            </div>
            <div class=" row col-xs-10 col-xs-offset-2 oculto mensaje">
                <label class="control-label" id="error_edita_nombre_estacion">&iexcl;Ingrese el
                    nombre!</label>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <!--Parqueos-->
        <div class="col-xs-2">
            <label for="btn_crear_estacionamiento"> Total de Estacionamientos</label>
        </div>

        <div class="col-xs-2">
            <input class="form-control" id="numero_estaciones" type="text"
                   maxlength="2" value="<?= Estacionamiento::contarNumeroEstacionamiento($estacion_actual->id) ?>"
                   onkeypress="return Escritorio.Validaciones.soloNumeros(event)"
                   onkeyup="Estacionamiento.label.cantidad();" disabled>
        </div>

        <!-- Button trigger modal crear estacionamiento -->
        <button type="button" class="btn btn-primary" title="Agrgar estacionamientos" data-toggle="modal"
                id="btn_crear_estacionamiento" data-target="#crear_estacionamiento" disabled><i
                class="fa fa-plus"></i></button>

        <!-- Modal Agregar -->
        <?php $Estacion->load->view('estacionamiento/crear'); ?>
    </div>

    <!--Mapa-->
    <div class="col-xs-12 col-sm-6 col-sm-offset-2">
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


