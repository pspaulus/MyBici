<div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Agregar Usuario</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_usuario">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label>ID</label>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" placeholder=""
                                       value="<?= $Usuario->cargarUltimoId() ?>" disabled="">
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="Descripcion">Login</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="nombre" type="text" maxlength="40"
                                           placeholder="Ingrese un nombre" value=""
                                           onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,4)">
                                    <label class="control-label vacio oculto" for="nombre" id="nombre_vacio">&iexcl;Ingrese
                                        nombre usuario!</label>
                                    <label class="control-label error oculto" for="nombre" id="nombre_error">&iexcl;El
                                        usuario debe contener al menos 4 caracteres!</label>
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="Descripcion">Contrase&ntilde;a</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="contrasena" type="password" maxlength="40"
                                           placeholder="Ingrese una contrase&ntilde;a" value=""
                                           onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8)">
                                    <label class="control-label vacio oculto" for="contrasena"
                                           id="contrasena_vacio">&iexcl;Ingrese contrase&ntilde;a!</label>
                                    <label class="control-label error oculto" for="contrasena"
                                           id="contrasena_error">&iexcl;La contrase&ntilde;a debe contener al menos 8
                                        caracteres!</label>
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="Descripcion">Confirmar Contrase&ntilde;a</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="confirmar_contrasena" type="password" maxlength="40"
                                           placeholder="repita la contrase&ntilde;a" value=""
                                           onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8)">
                                    <label class="control-label vacio oculto" for="confirmar_contrasena"
                                           id="confirmar_contrasena_vacio">&iexcl;Ingrese confirmaci&oacute;n de
                                        contrase&ntilde;a!</label>
                                    <label class="control-label error oculto" for="confirmar_contrasena"
                                           id="confirmar_contrasena_error">&iexcl;La confirmaci&oacute;n de contrase&ntilde;a
                                        debe contener al menos 8 caracteres!</label>

                                    <div class="has-error">
                                        <label class="control-label oculto" for="confirmar_contrasena"
                                               id="contrasena_no_coinciden">&iexcl;Las contrase&ntilde;as no
                                            coinciden!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label>Tipo</label>
                            </div>
                            <div class="col-xs-6" id="estado">
                                <select class="form-control" id="tipo_usuario">
                                    <option value="2">Est&aacute;ndar</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label>Estado</label>
                            </div>
                            <div class="col-xs-6" id="estado">
                                <select class="form-control" disabled>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Usuario.acciones.limpiar()">
                    Cancelar
                </button>
                <!--                        <button type="button" class="btn btn-primary" onclick="Usuario.acciones.guardar();" data-dismiss="modal">Guardar</button>-->
                <button type="button" class="btn btn-primary" onclick="Usuario.acciones.guardar();">Guardar</button>
            </div>

        </div>
    </div>
</div>