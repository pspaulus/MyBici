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
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="Descripcion">C&oacute;digo</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-3 col-sm-2">
                                    <input class="form-control" id="codigo" type="text" maxlength="1"
                                           placeholder="_" value=""
                                           onkeypress="return Escritorio.Validaciones.soloLetras(event)"
                                           onkeyup="Estacion.label.codigo()">
                                </div>
                                <div class="col-xs-4 oculto mensaje">
                                    <label class="control-label" id="error_codigo_parqueos">&iexcl;Ingrese el c&oacute;digo!</label>
                                </div>
                            </div>
                        </div>

                        <!--Nombre-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="Descripcion">Nombre</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-8 col-sm-6">
                                    <input class="form-control" id="nombre" type="text" maxlength="40"
                                           placeholder="Ingrese un nombre" value=""
                                           onkeyup="Estacion.label.nombre()">
                                </div>
                                <div class=" row col-xs-4 col-xs-offset-3 oculto mensaje">
                                    <label class="control-label" id="error_nombre_parqueos">&iexcl;Ingrese el
                                        nombre!</label>
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
                                            guardar_mapa("googleMap", -2.141470444145116, -79.96483281254768, 15);
                                        </script>
                                    </div>
                                </div>
                            <?php } else {
                                Escritorio::mostrarMensaje('no_muestra_contenido');
                            } ?>
                        </div>

                        <!--Longitud-->
                        <div class="form-group oculto">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="Descripcion">Longitud</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-6">
                                    <input class="form-control" id="longitud" type="text" maxlength="40" value="0"
                                           readonly onkeyup="Estacion.label.longitud()"
                                           onkeypress="return Escritorio.Validaciones.soloNumerosSimbolo(event)">
                                </div>
                                <div class=" row col-xs-4 col-xs-offset-3 oculto mensaje">
                                    <label class="control-label" id="error_longitud_parqueos">&iexcl;Ingrese
                                        longitud!</label>
                                </div>
                            </div>
                        </div>

                        <!--Latitud-->
                        <div class="form-group oculto">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="Descripcion">Latitud</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-6">
                                    <input class="form-control" id="latitud" type="text" maxlength="40" value="0"
                                           readonly onkeyup="Estacion.label.latitud()"
                                           onkeypress="return Escritorio.Validaciones.soloNumerosSimbolo(event)">
                                </div>
                                <div class=" row col-xs-4 col-xs-offset-3 oculto mensaje">
                                    <label class="control-label" id="error_latitud_parqueos">&iexcl;Ingrese
                                        latitud!</label>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="agrupador">
                                <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                                    <label class="control-label" id="error_ya_existe">&iexcl;C&oacute;digo o nombre
                                        duplicado!</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="Estacion.acciones.limpiar()">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="Estacion.acciones.guardar();">Guardar</button>
            </div>

        </div>
    </div>
</div>