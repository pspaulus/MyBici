<div class="modal fade" id="agregarBicicleta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Agregar Bicicleta
                </h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="form_estacion">
                    <div class="row">

                        <!--Estacion-->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                <label class="control-label"
                                       for="select_estacion_inventario_nuevo">Estaci&oacute;n</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-6 mensaje">
                                    <?php $estaciones = $Estacion->cargarEstaciones() ?>
                                    <select id="select_estacion_inventario_nuevo" class="form-control"
                                            onchange="Bicicleta.acciones.cargarUltimoCodigoEstacion();
                                                      Estacion.mensajes.oculta( $('#error_sin_estacion'));
                                                      Estacion.validaciones.EstacionamientoDisponible();">
                                        <?php foreach ($estaciones as $estacion) { ?>
                                            <option
                                                value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label" id="error_sin_estacion">&iexcl;No hay
                                        Estaci&oacute;n!</label>
                                </div>
                            </div>
                        </div>

                        <script>
                            var select_estacion = $('#select_estacion_inventario_nuevo').val();
                            if (select_estacion == null) {
                                Estacion.mensajes.mostrar($('#error_sin_estacion'));
                            }
                        </script>

                        <!--Codigo-->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sn-offset-1">
                                <label class="control-label" style="text-align: left !important;"
                                       for="input_codigo_estacion_nuevo">C&oacute;d. Bicicleta</label>
                            </div>
                            <div class="col-xs-3 col-sm-2">
                                <input class="form-control" type="text" value="" id="nuevo_codigo_mostrar" disabled>
                                <input class="form-control" type="hidden" id="input_codigo_estacion_nuevo"
                                       title="Estaci&oacute;n">
                                <input class="form-control" type="hidden" value="B" title="Bicicleta">
                                <input class="form-control" type="hidden" id="input_codigo_bicicleta_nuevo"
                                       title="Secuencia" value="">
                            </div>
                        </div>
                        <script>
                            Bicicleta.acciones.cargarUltimoCodigoEstacion();
                        </script>

                        <!--Cantidad-->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                <label class="control-label" for="input_cantidad_nuevo">Cantidad</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-3 col-sm-2">
                                    <input class="form-control" type="text" id="input_cantidad_nuevo" value="1"
                                           maxlength="2" onkeypress="return Escritorio.Validaciones.soloNumeros(event)"
                                           onkeyup="Estacion.mensajes.oculta($('#error_cantidad'));">
                                </div>
                                <div class="col-xs-offset-4 col-xs-8 col-sm-offset-3 col-sm-8 mensaje oculto">
                                    <label class="control-label" id="error_cantidad">&iexcl;Error de cantidad!</label>
                                </div>
                            </div>
                        </div>

                        <!--Tipo-->
                        <div class="form-group oculto">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label class="control-label" for="select_tipo_nuevo">Tipo</label>
                            </div>
                            <div class="col-xs-6">
                                <?php $bicicletas_tipos = $Tipo->getTipoBicicletas(); ?>
                                <select id="select_tipo_nuevo" class="form-control">
                                    <?php foreach ($bicicletas_tipos as $tipo) { ?>
                                        <option value="<?= $tipo->id; ?>"><?= $tipo->descripcion ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!--Estado-->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                <label class="control-label" for="select_estado_nuevo">Estado</label>
                            </div>
                            <div class="col-xs-6">
                                <?php $estados_bicicletas = $Estado->getEstadoBicicletas(); ?>
                                <select id="select_estado_nuevo" class="form-control">
                                    <?php foreach ($estados_bicicletas as $estado) { ?>
                                        <?php if ($estado->id == 9) continue; ?>
                                        <option
                                            value="<?= $estado->id; ?>" <?= ($estado->id == 7) ? 'selected' : ''; ?>><?= $estado->descripcion ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- parquearlas -->
                        <div class="form-group" id="opcion_parquear">
                            <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <small>
                                            <input id="parquear_bicicleta" type="checkbox">
                                            Estacionar las bicicletas despu&eacute;s de agregar
                                        </small>
                                    </label>
                                </div>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label" id="error_sin_parqueo">
                                        <small>&iexcl;La estaci&oacute;n no cuenta con estacionamientos disponibles!
                                        </small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <script>
                            Estacion.validaciones.EstacionamientoDisponible();
                        </script>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="Bicicleta.acciones.limpiar()">Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="Bicicleta.acciones.guardar()">Guardar</button>
            </div>

        </div>
    </div>
</div>