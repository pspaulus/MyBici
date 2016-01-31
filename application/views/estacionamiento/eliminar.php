<div class="modal fade" id="eliminar_estacionamiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-minus-circle"></i> Eliminar Estacionamientos</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="form_eliminar_estacion">
                    <div class="row">

                        <!-- estacionamientos -->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1">
                                <label for="numero_estaciones_nuevo">Cantidad</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-3">
                                    <input class="form-control" id="cantidad_eliminar" type="text" maxlength="2"
                                           value="1" onkeypress="return Escritorio.Validaciones.soloNumeros(event)"
                                           onkeyup="Estacion.mensajes.oculta($('#error_cantidad_eliminar'));">
                                </div>
                                <div class="col-xs-10 col-xs-offset-4 mensaje oculto">
                                    <label class="control-label" id="error_cantidad_eliminar">&iexcl;Error de
                                        cantidad!</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="Estacionamiento.acciones.limpiarEliminar()">Cancelar
                </button>
                <button type="button" class="btn btn-danger" onclick="Estacionamiento.acciones.eliminar()">Guardar</button>
            </div>

        </div>
    </div>
</div>