<div class="col-xs-12 col-md-6">

    <div class="row form-group">
        <input type="hidden" id="editar_estacion_id" value="<?= $estacion_actual->id ?>">
        <!--Codigo-->
        <div class="col-xs-3">
            <label for="editar_estacion_codigo">C&oacute;digo</label>
        </div>

        <div class="agrupador">
            <div class="col-xs-3 ">
                <input class="form-control" id="editar_estacion_codigo" type="text" maxlength="1"
                       placeholder="_" value="<?= $estacion_actual->codigo ?>"
                       onkeypress="return Escritorio.Validaciones.soloLetras(event)"
                       onkeyup="Estacion.mensajes.oculta($('#error_editar_codigo'));" disabled>
            </div>

            <div class="col-xs-9 col-xs-offset-3 oculto mensaje">
                <label class="control-label" id="error_editar_codigo">&iexcl;Ingrese una letra como
                    c&oacute;digo!</label>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <!--Nombre-->
        <div class="col-xs-3">
            <label for="editar_estacion_nombre">Nombre</label>
        </div>
            <div class="agrupador ">
            <div class="col-xs-9">
                <input class="form-control" id="editar_estacion_nombre" type="text" maxlength="40"
                       placeholder="Ingrese un nombre" value="<?= $estacion_actual->nombre ?>"
                       onkeyup="Estacion.mensajes.oculta($('#error_edita_nombre'));" disabled>
            </div>

            <div class="col-xs-9 col-xs-offset-3  oculto mensaje">
                <label class="control-label" id="error_edita_nombre">&iexcl;Ingrese el
                    nombre!</label>
            </div>
        </div>
    </div>

    <!--Longitud-->
    <div class="row form-group oculto" id="editar_longitud_sin_internet">
        <div class="col-xs-3">
            <label for="longitud">Longitud</label>
        </div>
        <div class="agrupador">
            <div class="col-xs-9">
                <input class="form-control" id="editar_longitud" type="text" maxlength="40" value="<?=$estacion_actual->longitud ?>"
                       placeholder="-79.963209628185723" disabled
                       onkeyup="Estacion.mensajes.oculta($('#error_editar_longitud'));"
                       onkeypress="return Escritorio.Validaciones.soloNumerosSimbolo(event)">
            </div>
            <div class=" row col-xs-9 col-xs-offset-3 oculto mensaje">
                <label class="control-label" id="error_editar_longitud">&iexcl;Ingrese
                    longitud!</label>
            </div>
        </div>
    </div>

    <!--Latitud-->
    <div class="row form-group oculto" id="editar_latitud_sin_internet">
        <div class="col-xs-3">
            <label for="latitud">Latitud</label>
        </div>
        <div class="agrupador">
            <div class="col-xs-9">
                <input class="form-control" id="editar_latitud" type="text" maxlength="40" value="<?=$estacion_actual->latitud ?>"
                       placeholder="-2.1477960235290756" disabled
                       onkeyup="Estacion.mensajes.oculta($('#error_editar_latitud'));"
                       onkeypress="return Escritorio.Validaciones.soloNumerosSimbolo(event)">
            </div>
            <div class=" row col-xs-4 col-xs-offset-3 oculto mensaje">
                <label class="control-label" id="error_editar_latitud">&iexcl;Ingrese
                    latitud!</label>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <!--Parqueos-->
        <div class="col-xs-3">
            <label for="btn_crear_estacionamiento"> Total de Estacionamientos</label>
        </div>

        <div class="col-xs-3">
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
</div>

<div class="col-xs-12 col-md-6">

    <!--ver mapa estacion -->
    <?php if (Escritorio::verificarInternet()) { ?>
        <div class="panel panel-primary" id="div_mapa_ver">
            <div class="panel-heading">
                <h3 class="panel-title">Ubicaci&oacute;n</h3>
            </div>
            <div class="panel-body">
                <input type="hidden" id="estacion_actual_codigo" value="<?= $estacion_actual->codigo ?>">
                <input type="hidden" id="estacion_actual_latitud" value="<?= $estacion_actual->latitud ?>">
                <input type="hidden" id="estacion_actual_longitud" value="<?= $estacion_actual->longitud ?>">

                <div class="estacion oculto" data-nombre="<?= $estacion_actual->nombre ?>"
                     data-codigo="<?= $estacion_actual->codigo ?>"
                     data-latitud="<?= $estacion_actual->latitud ?>" data-longitud="<?= $estacion_actual->longitud ?>">
                </div>
                <div id="ubicacionEstacion" class="mapa"></div>
            </div>
        </div>
        <script>
            ver_mapa('ubicacionEstacion',
                <?= $estacion_actual->latitud ?>,
                <?= $estacion_actual->longitud ?>
            );
        </script>
    <?php } else {

        Escritorio::Mensaje('no_muestra_contenido');
    } ?>

    <!-- editar mapa estacion -->
    <?php if (Escritorio::verificarInternet()) { ?>
        <div class="panel panel-primary" id="div_mapa_editar">
            <div class="panel-heading">
                <h3 class="panel-title">Ubicaci&oacute;n</h3>
            </div>
            <div class="panel-body">
                <div id="editar_mapa_estacion" class="mapa"></div>
                <script>
                    editar_mapa("editar_mapa_estacion",
                        <?=$estacion_actual->latitud ?>,
                        <?= $estacion_actual->longitud ?>
                    );
                </script>
            </div>
        </div>
    <?php } else {
        Escritorio::Mensaje('no_muestra_contenido');
    } ?>
</div>

<script>
    Estacion.validaciones.habilitarRegistroSinInterner();
    $('#div_mapa_editar').addClass('oculto');
</script>

