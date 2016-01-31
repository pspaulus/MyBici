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
                <form class="form-horizontal" id="form_usuario_<?= $obj_usuario->id ?>">
                    <div class="row">

                        <!-- id -->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                <label class="control-label" for="id<?= $obj_usuario->id ?>">ID</label>
                            </div>
                            <div class="col-xs-3 col-sm-2">
                                <input class="form-control" type="text" id="id<?= $obj_usuario->id ?>"
                                       value="<?= $obj_usuario->id ?>" disabled>
                            </div>
                        </div>

                        <!-- nombre -->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                <label for="nombre_editar<?= $obj_usuario->id ?>">Login</label>
                            </div>

                            <div class="col-xs-6">
                                <input class="form-control" id="nombre_editar<?= $obj_usuario->id ?>" type="text"
                                       value="<?= $obj_usuario->nombre ?>" disabled>
                            </div>
                        </div>

                        <!-- contraseña -->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                <label for="contrasena_editar<?= $obj_usuario->id ?>">Contrase&ntilde;a</label>
                            </div>

                            <div class="agrupador">
                                <div class="col-xs-6">
                                    <input class="form-control" id="contrasena_editar<?= $obj_usuario->id ?>"
                                           type="password" maxlength="25"
                                           placeholder="Ingrese una contrase&ntilde;a"
                                           value="<?= $obj_usuario->contrasena ?>"
                                           onkeyup="Estacion.mensajes.oculta($('#contrasena_vacio_<?= $obj_usuario->id ?>'));
                                               Estacion.mensajes.oculta($('#contrasena_error_<?= $obj_usuario->id ?>'));
                                               Estacion.mensajes.oculta($('#error_mayuscula_<?= $obj_usuario->id ?>'));
                                               Estacion.mensajes.oculta($('#error_numero_<?= $obj_usuario->id ?>'));">
                                </div>
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label" for="contrasena_editar<?= $obj_usuario->id ?>"
                                           id="contrasena_vacio_<?= $obj_usuario->id ?>">&iexcl;Ingrese contrase&ntilde;a!</label>
                                </div>
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label" for="contrasena_editar<?= $obj_usuario->id ?>"
                                           id="contrasena_error_<?= $obj_usuario->id ?>">&iexcl;La contrase&ntilde;a
                                        debe contener al menos 8 caracteres!</label>
                                </div>
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label" for="contrasena_editar<?= $obj_usuario->id ?>"
                                           id="error_mayuscula_<?= $obj_usuario->id ?>a"> &iexcl;Las contrase&ntilde;a
                                        debe contener una letra may&uacute;scula!</label>
                                </div>
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label" for="contrasena_editar<?= $obj_usuario->id ?>"
                                           id="error_numero_<?= $obj_usuario->id ?>">&iexcl;Las contrase&ntilde;a debe
                                        contener un n&uacute;mero!</label>
                                </div>
                            </div>
                        </div>

                        <!-- confirmar contraseña -->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                <label for="confirmar_contrasena_editar<?= $obj_usuario->id ?>">Confirme Contrase&ntilde;a</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-6">
                                    <input class="form-control"
                                           id="confirmar_contrasena_editar<?= $obj_usuario->id ?>"
                                           type="password" maxlength="25" placeholder="repita la contrase&ntilde;a"
                                           value="<?= $obj_usuario->contrasena ?>"
                                           onkeyup="Estacion.mensajes.oculta($('#confirmar_contrasena_vacio_<?= $obj_usuario->id ?>'));
                                                    Estacion.mensajes.oculta($('#contrasena_no_coinciden_<?= $obj_usuario->id ?>'));">
                                </div>
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label"
                                           for="confirmar_contrasena_editar<?= $obj_usuario->id ?>"
                                           id="confirmar_contrasena_vacio_<?= $obj_usuario->id ?>">&iexcl;Ingrese confirmaci&oacute;n de
                                        contrase&ntilde;a!</label>
                                </div>
                                <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 mensaje oculto">
                                    <label class="control-label"
                                           for="confirmar_contrasena_editar<?= $obj_usuario->id ?>"
                                           id="contrasena_no_coinciden_<?= $obj_usuario->id ?>">&iexcl;Las contrase&ntilde;as no
                                        coinciden!</label>
                                </div>
                            </div>
                        </div>

                        <!-- tipo -->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1 text-left">
                                <label class="control-label"
                                       for="tipo_usuario_editar<?= $obj_usuario->id ?>">Tipo</label>
                            </div>
                            <div class="col-xs-6 text-left" id="estado">
                                <select class="form-control" id="tipo_usuario_editar<?= $obj_usuario->id ?>">
                                    <?php if ($tdu == 1){?>
                                        <option value="8" <?= ($obj_usuario->TIPO_id == 8) ? 'selected' : '' ?>>Operario
                                        </option>
                                    <?php }?>
                                    <option value="2" <?= ($obj_usuario->TIPO_id == 2) ? 'selected' : '' ?>>Est&aacute;ndar</option>
                                </select>
                            </div>
                        </div>

                        <!-- estado -->
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
                <div id="botones_modal_editar_<?= $obj_usuario->id ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                            onclick="Usuario.acciones.limpiarEditar()">Cancelar
                    </button>
                    <button type="button" class="btn btn-primary"
                            onclick="Usuario.acciones.editar(<?= $obj_usuario->id ?>)">Actualizar
                    </button>
                <div id="botones_modal_editar_<?= $obj_usuario->id ?>">
            </div>

        </div>
    </div>
</div>