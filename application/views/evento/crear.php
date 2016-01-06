<div class="modal fade" id="crearEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Crear Evento</h4>
            </div>

            <div class="modal-body">
                <div class="form-horizontal" role="form">

                    <!-- tipo -->
                    <div class="row">
                        <div class="form-group">
                            <div class="agrupador">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label class="control-label" for="evento_tipo">Tipo</label>
                                </div>
                                <div class="col-xs-6">
                                    <select class="form-control" id="evento_tipo" disabled>
                                        <?php $tipos = Evento::cargarTipos(); ?>
                                        <?php foreach ($tipos as $tipo) { ?>
                                            <option value="<?= $tipo->id ?>"><?= $tipo->descripcion ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                                    <label class="control-label" id="tipo_vacio">&iexcl;No hay tipo
                                        seleccionado!</label>
                                </div>
                            </div>
                        </div>

                        <!-- nombre -->
                        <div class="form-group">
                            <div class="agrupador">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label class="control-label" for="evento_nombre">Nombre</label>
                                </div>

                                <div class="col-xs-6">
                                    <input class="form-control" type="text" placeholder="Ingrese nombre"
                                           id="evento_nombre" onkeyup="Estacion.mensajes.oculta($('#nombre_vacio'));">
                                </div>

                                <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                                    <label class="control-label" id="nombre_vacio">&iexcl;Ingrese nombre!</label>
                                </div>
                            </div>
                        </div>

                        <!-- descripcion -->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label class="control-label" for="evento_descripcion">Descripci&oacute;n</label>
                            </div>
                            <div class="col-xs-6">
                                <textarea class="form-control" id="evento_descripcion"
                                          placeholder="Opcional"></textarea>
                            </div>
                        </div>

                        <!--Cantidad-->
                        <div class="form-group">
                            <div class="agrupador">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label class="control-label" for="evento_cantidad">Cant. de Participantes</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" type="input" id="evento_cantidad" value="10"
                                           maxlength="3" onkeypress="return Escritorio.Validaciones.soloNumeros(event)"
                                           onkeyup="Bicicleta.acciones.validarCantidad();">
                                </div>
                                <div class="col-xs-4 mensaje oculto">
                                    <label class="control-label" id="error_cantidad">&iexcl;Error de cantidad!</label>
                                </div>
                            </div>
                        </div>

                        <!-- estados -->
                        <div class="form-group">
                            <div class="agrupador">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label class="control-label" for="evento_estado">Estado</label>
                                </div>
                                <div class="col-xs-6">
                                    <select class="form-control" disabled id="evento_estado">
                                        <?php $estados = Evento::cargarEstados(); ?>
                                        <?php foreach ($estados as $estado) { ?>
                                            <option value="<?= $estado->id ?>"><?= $estado->descripcion ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                                    <label class="control-label" id="estado_vacio">&iexcl;No hay estado
                                        seleccionado!</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                            onclick="Evento.acciones.limpiar()">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" onclick="Evento.acciones.guardar()">Guardar</button>
                </div>

            </div>
        </div>
    </div>
</div>