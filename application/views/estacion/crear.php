<div class="modal fade" id="crearEstacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Crear Estaci&oacute;n</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_estacion">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label>ID</label>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" value="<?= $Estacion->cargarUltimoId() ?>"
                                       id="estacion_id" disabled="">
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="Descripcion">Nombre</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="nombre" type="text" maxlength="40"
                                           placeholder="Ingrese un nombre" value=""
                                           onkeyup="">
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="Descripcion">Coordenada X</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="coordenada_x" type="text" maxlength="40"
                                           placeholder="-2.15222" value=""
                                           onkeyup="">
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="Descripcion">Coordenada Y</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="coordenada_y" type="text" maxlength="40"
                                           placeholder="-79.9529" value=""
                                           onkeyup="">
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="Descripcion"> No. de Parqueos</label>
                                </div>
                                <div class="col-xs-2 mensaje">
                                    <input class="form-control" id="numero_estaciones" type="number" min="0" max="999"
                                           maxlength="3" value="1">
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