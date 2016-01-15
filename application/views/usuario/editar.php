<div class="modal fade" id="editarUsuario_<?= $obj_usuario->id ?>" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-left" id="myModalLabel"><i class="fa fa-edit"></i> Editar Usuario</h4>
            </div>

            <div class="modal-body contraer">
                <form class="form-horizontal" id="form_usuario">
                    <div class="row">

                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                    <label>ID</label>
                                </div>
                                <div class="col-xs-6">
                                    <input class="form-control" type="text" placeholder=""
                                           value="<?= $obj_usuario->id ?>" disabled="">
                                </div>
                            </div>
                        </div>

                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                    <label for="nombre_editar<?= $obj_usuario->id ?>">Login</label>
                                </div>
                                <div class="mensaje">
                                    <div class="col-xs-6">
                                        <input class="form-control" id="nombre_editar<?= $obj_usuario->id ?>"
                                               type="text" disabled
                                               maxlength="25" placeholder="Ingrese un nombre"
                                               value="<?= $obj_usuario->nombre ?>"
                                               onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,4);">

                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 vacio oculto text-left">
                                        <label class="control-label" for="nombre_editar"
                                               id="nombre_editar_vacio">&iexcl;Ingrese usuario!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 error oculto">
                                        <label class="control-label" for="nombre_editar"
                                               id="nombre_edita_error">&iexcl;El usuario debe contener al menos 4
                                            caracteres!</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                    <label for="contrasena_editar<?= $obj_usuario->id ?>">Contrase&ntilde;a</label>
                                </div>
                                <div class="mensaje">
                                    <div class="col-xs-6">
                                        <input class="form-control" id="contrasena_editar<?= $obj_usuario->id ?>"
                                               type="password" maxlength="25" placeholder="Ingrese una contrase&ntilde;a"
                                               value="<?= $obj_usuario->contrasena ?>"
                                               onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8)">
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 vacio oculto text-left">
                                        <label class="control-label" for="contrasena_editar"
                                               id="contrasena_editar_vacio">&iexcl;Ingrese contrase&ntilde;a!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 error oculto">
                                    <label class="control-label" for="contrasena_editar"
                                           id="contrasena_editar_error">&iexcl;La contrase&ntilde;a debe contener al
                                        menos 8 caracteres!</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                    <label for="confirmar_contrasena_editar<?= $obj_usuario->id ?>">Confirme Contrase&ntilde;a</label>
                                </div>
                                <div class="mensaje">
                                    <div class="col-xs-6">
                                        <input class="form-control" id="confirmar_contrasena_editar<?= $obj_usuario->id ?>"
                                               type="password" maxlength="25" placeholder="repita la contrase&ntilde;a"
                                               value="<?= $obj_usuario->contrasena ?>"
                                               onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8);
                                                        $('#error_numero').parent('.menssaje').addClass(' oculto');
                                                        $('#error_mayuscula').parent('.menssaje').addClass(' oculto');">
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 vacio oculto text-left">
                                        <label class="control-label" for="confirmar_contrasena_editar"
                                               id="confirmar_contrasena_vacio">&iexcl;Ingrese confirmaci&oacute;n de
                                            contrase&ntilde;a!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-2 error oculto">
                                    <label class="control-label" for="confirmar_contrasena_editar"
                                           id="confirmar_contrasena_error">&iexcl;La confirmaci&oacute;n de contrase&ntilde;a
                                        debe contener al menos 8 caracteres!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 has-error">
                                        <label class="control-label oculto" for="confirmar_contrasena_editar"
                                               id="contrasena_no_coinciden_editar<?= $obj_usuario->id ?>">&iexcl;Las
                                            contrase&ntilde;as no coinciden!</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 menssaje has-error oculto">
                                        <label class="control-label" id="error_mayuscula">&iexcl;Las contrase&ntilde;a
                                            debe contener una letra may&uacute;scula!</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 menssaje has-error oculto">
                                        <label class="control-label" id="error_numero">&iexcl;Las contrase&ntilde;a
                                            debe contener un n&uacute;mero!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                <label class="control-label" for="tipo_usuario_editar<?= $obj_usuario->id ?>">Tipo</label>
                            </div>
                            <div class="col-xs-6 text-left" id="estado">
                                <select class="form-control" id="tipo_usuario_editar<?= $obj_usuario->id ?>">
                                    <option value="2" <?= ($obj_usuario->TIPO_id == 2) ? 'selected' : '' ?>>Est&aacute;ndar</option>
                                    <option value="1" <?= ($obj_usuario->TIPO_id == 1) ? 'selected' : '' ?>>
                                        Administrador
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                <label class="control-label" for="estado_editar<?= $obj_usuario->id ?>">Estado</label>
                            </div>
                            <div class="col-xs-6">
                                <select class="form-control" id="estado_editar<?= $obj_usuario->id ?>">
                                    <option value="1" <?= ($obj_usuario->ESTADO_id == 1) ? 'selected' : '' ?>>Activo
                                    </option>
                                    <option value="2" <?= ($obj_usuario->ESTADO_id == 2) ? 'selected' : '' ?>>Inactivo
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="Usuario.acciones.limpiarEditar()">Cancelar
                </button>
                <button type="button" class="btn btn-primary"
                        onclick="Usuario.acciones.editar(<?= $obj_usuario->id ?>)">Actualizar
                </button>
            </div>

        </div>
    </div>
</div>