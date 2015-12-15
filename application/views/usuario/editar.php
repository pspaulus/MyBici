<div class="modal fade" id="editarUsuario_<?= $obj_usuario->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-left" id="myModalLabel">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_usuario">
                    <div class="row">
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1 text-left">
                                    <label>ID</label>
                                </div>
                                <div class="col-xs-6">
                                    <input class="form-control" type="text" placeholder="" value="<?= $obj_usuario->id ?>" disabled="">
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1 text-left">
                                    <label for="Descripcion">Login</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="nombre_editar<?= $obj_usuario->id ?>" type="text" maxlength="40" placeholder="Ingrese un nombre" value="<?= $obj_usuario->nombre ?>" onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,4)">
                                    <label class="control-label vacio oculto" for="nombre_editar" id="nombre_editar_vacio">&iexcl;Ingrese usuario!</label>
                                    <label class="control-label error oculto" for="nombre_editar" id="nombre_edita_error">&iexcl;El usuario debe contener al menos 4 caracteres!</label>
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1 text-left">
                                    <label for="Descripcion">Contrase&ntilde;a</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="contrasena_editar<?= $obj_usuario->id ?>" type="password" maxlength="40" placeholder="Ingrese una contrase&ntilde;a" value="<?= $obj_usuario->contrasena ?>" onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8)">
                                    <label class="control-label vacio oculto" for="contrasena_editar" id="contrasena_editar_vacio">&iexcl;Ingrese contrase&ntilde;a!</label>
                                    <label class="control-label error oculto" for="contrasena_editar" id="contrasena_editar_error">&iexcl;La contrase&ntilde;a debe contener al menos 8 caracteres!</label>
                                </div>
                            </div>
                        </div>
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-2 col-xs-offset-1 text-left">
                                    <label for="Descripcion">Confirme Contrase&ntilde;a</label>
                                </div>
                                <div class="col-xs-6 mensaje">
                                    <input class="form-control" id="confirmar_contrasena_editar<?= $obj_usuario->id ?>" type="password" maxlength="40" placeholder="repita la contrase&ntilde;a" value="<?= $obj_usuario->contrasena ?>" onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8)">
                                    <label class="control-label vacio oculto" for="confirmar_contrasena_editar" id="confirmar_contrasena_vacio">&iexcl;Ingrese confirmaci&oacute;n de contrase&ntilde;a!</label>
                                    <label class="control-label error oculto" for="confirmar_contrasena_editar" id="confirmar_contrasena_error">&iexcl;La confirmaci&oacute;n de contrase&ntilde;a debe contener al menos 8 caracteres!</label>
                                    <div class="has-error">
                                        <label class="control-label oculto" for="confirmar_contrasena_editar" id="contrasena_no_coinciden_editar<?= $obj_usuario->id ?>">&iexcl;Las contrase&ntilde;as no coinciden!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                <label>Tipo</label>
                            </div>
                            <div class="col-xs-6 text-left" id="estado" >
                                <select class="form-control" id="tipo_usuario_editar<?= $obj_usuario->id ?>">
                                    <option value="2" <?= ($obj_usuario->TIPO_id == 2)? 'selected' : '' ?>>Est&aacute;ndar</option>
                                    <option value="1" <?= ($obj_usuario->TIPO_id == 1)? 'selected' : '' ?>>Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                <label>Estado</label>
                            </div>
                            <div class="col-xs-6">
                                <select class="form-control"  id="estado_editar<?= $obj_usuario->id ?>">
                                    <option value="1" <?= ($obj_usuario->ESTADO_id == 1)? 'selected' : '' ?>>Activo</option>
                                    <option value="2" <?= ($obj_usuario->ESTADO_id == 2)? 'selected' : '' ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Usuario.acciones.limpiarEditar()">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="Usuario.acciones.editar(<?= $obj_usuario->id ?>)">Actualizar</button>
            </div>

        </div>
    </div>
</div>