<div class="modal fade" id="crear_estacionamiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Agregar Estacionamientos</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="form_estacion">
                    <div class="row">
                        <!--Parqueos-->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1">
                                <label for="Descripcion">Cantidad</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-3">
                                    <input class="form-control" id="numero_estaciones_nuevo" type="text" maxlength="2"
                                           value="1" onkeypress="return Escritorio.Validaciones.soloNumeros(event)"
                                           onkeyup="Estacionamiento.label.cantidad();">
                                </div>
                                <div class="col-xs-10 col-xs-offset-4 mensaje oculto">
                                    <label class="control-label" id="error_cantidad_parqueos">&iexcl;Error de
                                        cantidad!</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="Estacionamiento.acciones.limpiar()">Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="Estacionamiento.acciones.guardar()">Guardar</button>
            </div>

        </div>
    </div>
</div>