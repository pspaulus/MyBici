<div class="modal fade" id="crearEstacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Crear Estaci&oacute;n</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="form_estacion">
                    <div class="row">

                        <!--Codigo-->
                        <div class="form-group">
                            <div class="agrupador">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="codigo">C&oacute;digo</label>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <input class="form-control" id="codigo" type="text" maxlength="1"
                                           placeholder="A" value=""
                                           onkeypress="return Escritorio.Validaciones.soloLetras(event)"
                                           onkeyup="Estacion.label.codigo(); Estacion.label.duplicadoCodigo();"
                                           onblur="Estacion.acciones.existeCodigo($('#codigo'))">
                                </div>
                                <div id="busy_codigo"></div>
                                <input type="hidden" id="existeCodigo" value="1">
                                <div class="col-xs-6 oculto mensaje">
                                    <label class="control-label" id="error_codigo_parqueos">&iexcl;Ingrese el
                                        c&oacute;digo!</label>
                                </div>
                                <div class="col-xs-6 oculto mensaje">
                                    <label class="control-label" id="codigo_duplicado">&iexcl;C&oacute;digo
                                        ya existe!</label>
                                </div>
                            </div>
                        </div>

                        <!--Nombre-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="nombre">Nombre</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-8 col-sm-6">
                                    <input class="form-control" id="nombre" type="text" maxlength="40"
                                           placeholder="Ingrese un nombre" value=""
                                           onkeyup="Estacion.label.nombre(); Estacion.label.duplicadoNombre();"
                                           onblur="Estacion.acciones.existeNombre($('#nombre'))">
                                    <input type="hidden" id="existeNombre" value="1">
                                </div>
                                <div id="busy_nombre"></div>
                                <div class=" row col-xs-9 col-xs-offset-3 oculto mensaje">
                                    <label class="control-label" id="error_nombre_parqueos">&iexcl;Ingrese el
                                        nombre!</label>
                                </div>
                                <div class=" row col-xs-9 col-xs-offset-3 oculto mensaje">
                                    <label class="control-label" id="nombre_duplicado">&iexcl;Nombre ya existe!</label>
                                </div>
                            </div>
                        </div>

                        <!--Longitud-->
                        <div class="form-group oculto" id="longitud_sin_internet">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="longitud">Longitud</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-6">
                                    <input class="form-control" id="longitud" type="text" maxlength="40" value=""
                                           onkeyup="Estacion.label.longitud()" placeholder="-79.963209628185723"
                                           onkeypress="return Escritorio.Validaciones.soloNumerosSimbolo(event)">
                                </div>
                                <div class=" row col-xs-4 col-xs-offset-3 oculto mensaje">
                                    <label class="control-label" id="error_longitud_parqueos">&iexcl;Ingrese
                                        longitud!</label>
                                </div>
                            </div>
                        </div>

                        <!--Latitud-->
                        <div class="form-group oculto" id="latitud_sin_internet">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="latitud">Latitud</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-6">
                                    <input class="form-control" id="latitud" type="text" maxlength="40" value=""
                                           onkeyup="Estacion.label.latitud()" placeholder="-2.1477960235290756"
                                           onkeypress="return Escritorio.Validaciones.soloNumerosSimbolo(event)">
                                </div>
                                <div class=" row col-xs-4 col-xs-offset-3 oculto mensaje">
                                    <label class="control-label" id="error_latitud_parqueos">&iexcl;Ingrese
                                        latitud!</label>
                                </div>
                            </div>
                        </div>

                        <!-- mapa -->
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                            <?php if (Escritorio::verificarInternet()) { ?>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Ubicaci&oacute;n</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div id="googleMap" class="mapa"></div>
                                        <script>
                                            guardar_mapa("googleMap");
                                        </script>

                                    </div>
                                    <div class="agrupador">
                                        <div class="row col-xs-9 col-xs-offset-3 oculto mensaje">
                                            <label class="control-label" id="error_coordenadas_mapa">&iexcl;Indique ubicaci&oacuten en el mapa!</label>
                                        </div>
                                    </div>
                                </div>
                            <?php } else {
                                Escritorio::Mensaje('no_muestra_contenido');
                            } ?>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Estacion.acciones.limpiar()">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="Estacion.acciones.guardar();">Guardar</button>
            </div>

        </div>
    </div>
</div>

