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

                        <!--ID-->
                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                <label>ID</label>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control" type="text"
                                       value="<?= $Usuario->cargarUltimoId() ?>" disabled="">
                            </div>
                        </div>

                        <!--Login-->
                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                    <label for="nombre">Login</label>
                                </div>
                                <div class="mensaje">
                                    <div class="col-xs-6">
                                        <input class="form-control" id="nombre" type="text" maxlength="25"
                                               placeholder="Ingrese un nombre"
                                               onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,4);
                                                        $('#nombre_duplicado').parent('.duplicado').addClass(' oculto');
                                                        $('#nombre').parents('.agrupador').children('.form-group').children('.mensaje').removeClass(' has-error');"
                                               onblur="Usuario.acciones.existeUsuario($('#nombre'));
                                                       Usuario.acciones.validarNumeroCaracteresUsuario(this,4)">
                                        <input type="hidden" id="existeUsuario" value="1">

                                    </div>
                                    <div id="busy_nombre"></div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 vacio oculto">
                                        <label class="control-label" for="nombre" id="nombre_vacio">&iexcl;Ingrese
                                            nombre usuario!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 error oculto">
                                        <label class="control-label" for="nombre" id="nombre_error">&iexcl;El
                                            usuario debe contener al menos 4 caracteres!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 has-error duplicado oculto">
                                        <label class="control-label" id="nombre_duplicado">&iexcl;El nombre ya se
                                            encuentra en uso!</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                    <label for="contrasena">Contrase&ntilde;a</label>
                                </div>
                                <div class="mensaje">
                                    <div class="col-xs-6">
                                        <input class="form-control" id="contrasena" type="password" maxlength="25"
                                               placeholder="Ingrese una contrase&ntilde;a" value=""
                                               onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8);
                                                        $('#error_numero').parent('.menssaje').addClass(' oculto');
                                                        $('#error_mayuscula').parent('.menssaje').addClass(' oculto') ;">
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 vacio oculto">
                                        <label class="control-label" for="contrasena"
                                               id="contrasena_vacio">&iexcl;Ingrese contrase&ntilde;a!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 error oculto">
                                        <label class="control-label" for="contrasena"
                                               id="contrasena_error">&iexcl;La contrase&ntilde;a debe contener al menos
                                            8 caracteres!</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="agrupador">
                            <div class="form-group">
                                <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                    <label for="confirmar_contrasena">Confirmar Contrase&ntilde;a</label>
                                </div>
                                <div class="mensaje">
                                    <div class="col-xs-6">
                                        <input class="form-control" id="confirmar_contrasena" type="password"
                                               maxlength="25"
                                               placeholder="Repita la contrase&ntilde;a" value=""
                                               onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8);
                                                $('#error_numero').parent('.menssaje').addClass(' oculto');
                                                $('#error_mayuscula').parent('.menssaje').addClass(' oculto');">
                                    </div>
                                    <div class="col-xs-2"></div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 vacio oculto">
                                        <label class="control-label" for="confirmar_contrasena"
                                               id="confirmar_contrasena_vacio">&iexcl;Ingrese confirmaci&oacute;n de
                                            contrase&ntilde;a!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 error oculto">
                                        <label class="control-label" for="confirmar_contrasena"
                                               id="confirmar_contrasena_error">&iexcl;La confirmaci&oacute;n debe
                                            contener al menos 8 caracteres!</label>
                                    </div>
                                    <div class="col-xs-8 col-xs-offset-4 col-sm-9 col-sm-offset-3 has-error">
                                        <label class="control-label oculto" for="confirmar_contrasena"
                                               id="contrasena_no_coinciden">&iexcl;Las contrase&ntilde;as no
                                            coinciden!</label>
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
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                <label for="tipo_usuario">Tipo</label>
                            </div>
                            <div class="col-xs-6" id="estado">
                                <select class="form-control" id="tipo_usuario">
                                    <?php $tipos = Tipo::getEstadoUsuario(); ?>
                                    <?php foreach ($tipos as $tipo) { ?>
                                        <option value="<?= $tipo->id ?>" <?= ($tipo->id == 2)?'selected="true"':'';?>><?= $tipo->descripcion ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-3 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                                <label class="control-label" for="estado">Estado</label>
                            </div>
                            <div class="col-xs-6" id="estado">
                                <select class="form-control" disabled>
                                    <?php $estados = Estado::getEstadoUsuario(); ?>
                                    <?php foreach ($estados as $estado) { ?>
                                        <option value="<?= $estado->id ?>" <?= ($estado->id == 1)?'selected="true"':'';?>><?= $estado->descripcion ?></option>
                                    <?php } ?>
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
                <button type="button" class="btn btn-primary" onclick="Usuario.acciones.guardar();">Guardar</button>
            </div>

        </div>
    </div>
</div>