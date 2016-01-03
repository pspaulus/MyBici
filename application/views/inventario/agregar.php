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
                        <div class="agrupador">
                            <div class="form-group">
                                <!--Select Estacion-->
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label class="control-label"
                                           for="select_estacion_inventario_nuevo">Estaci&oacute;n</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <?php $estaciones = $Estacion->cargarEstaciones() ?>
                                    <select id="select_estacion_inventario_nuevo" class="form-control"
                                            onchange="Bicicleta.acciones.cargarUltimoCodigoEstacion();
                                                      Estacion.mensajes.oculta( $('#error_sin_estacion'));">
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
                            </div>
                        </div>

                        <!--Codigo-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label class="control-label"
                                       for="input_codigo_estacion_nuevo">C&oacute;d. Bicicleta</label>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" type="text" id="input_codigo_estacion_nuevo" value=""
                                       title="Estaci&oacute;n" disabled>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" type="text" value="B" title="Bicicleta" disabled>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" type="text" id="input_codigo_bicicleta_nuevo"
                                       title="Secuencia" value="" disabled>
                            </div>
                            <script>
                                Bicicleta.acciones.cargarUltimoCodigoEstacion();
                            </script>
                        </div>

                        <!--Cantidad-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label class="control-label" for="input_cantidad_nuevo">Cantidad</label>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" type="input" id="input_cantidad_nuevo" value="1"
                                       maxlength="2" onkeypress="return Escritorio.Validaciones.soloNumeros(event)"
                                       onkeyup="Bicicleta.acciones.validarCantidad();">
                            </div>
                            <div class="col-xs-2 mensaje oculto">
                                <label class="control-label" id="error_cantidad">&iexcl;Error de cantidad!</label>
                            </div>
                        </div>

                        <!--Tipo-->
                        <div class="form-group">
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
                            <div class="col-xs-2 col-xs-offset-1">
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
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <small>
                                            <input id="parquear_bicicleta" type="checkbox">
                                            Estacionarlas despu&eacute;s de agregar
                                        </small>
                                    </label>
                                </div>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                                    <label class="control-label" id="error_sin_parqueo"><small>&iexcl;La estaci&oacute;n no cuenta con estacionamientos disponibles!</small></label>
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