<div class="modal fade" id="verUsuario_<?= $obj_usuario->id ?>" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-left" id="myModalLabel"><i class="fa fa-search"></i> Ver Usuario</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_usuario">
                    <div class="row">

                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                <label>ID</label>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" placeholder="" value="<?= $obj_usuario->id ?>"
                                       disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                <label for="Descripcion">Nombre</label>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control" id="nombre_ver" type="text" maxlength="40"
                                       placeholder="Ingrese un nombre" value="<?= $obj_usuario->nombre ?>" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                <label for="Descripcion">Contrase&ntilde;a</label>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control" id="contrasena_ver" type="password" maxlength="40"
                                       placeholder="Ingrese una contrase&ntilde;a"
                                       value="<?= $obj_usuario->contrasena ?>" disabled="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                <label>Tipo</label>
                            </div>
                            <div class="col-xs-6" id="estado">
                                <select class="form-control" id="tipo_usuario" disabled="">
                                    <option value="2" <?= ($obj_usuario->TIPO_id == 2) ? 'selected' : '' ?>>Est&aacute;ndar</option>
                                    <option value="1" <?= ($obj_usuario->TIPO_id == 1) ? 'selected' : '' ?>>
                                        Administrador
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                <label>Estado</label>
                            </div>
                            <div class="col-xs-6">

                                <select class="form-control" id="estado_editar" disabled="">
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
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>

        </div>
    </div>
</div>