<input type="hidden" value="<?= $_SERVER['HTTP_HOST'] ?>/web/MyBici_server/" id="s_ip">
<div class="container" id="formLogin">

    <!--Titulo-->
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <h1 class="page-header text-center text-color-white">
                <i class="fa fa-fw fa-bicycle"></i> MyBici Server
            </h1>
        </div>
    </div>

    <!--texo login-->
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">
            <div class="form-group">
                <h3 class="text-center text-color-white">
                    <i class="fa fa-fw fa-key"></i> Login
                </h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">
            <div class="form-group" id="formulario_ingresar">

                <!-- nombre -->
                <div class="agrupador">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-user"></i>&nbsp;</div>
                        <input type="text" class="form-control" placeholder="Usuario" id="usuario" maxlength="40"
                               onkeyup="Estacion.mensajes.oculta($('#usuario_vacio'));
                                        Estacion.mensajes.oculta($('#usuario_error'));
                                        Estacion.mensajes.oculta($('#usuario_contrasena_incorrecta'));
                                        Login.index.pressEnter(event)">
                    </div>
                    <div class="mensaje text-center oculto">
                        <label class="control-label" for="usuario" id="usuario_vacio">&iexcl;Ingrese usuario!</label>
                    </div>
                    <div class="mensaje text-center oculto">
                        <label class="control-label" for="usuario" id="usuario_error">&iexcl;El usuario debe contener al
                            menos 4
                            caracteres!</label>
                    </div>
                </div>

                <!-- clave -->
                <div class="agrupador">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i>&nbsp;</div>
                        <input type="password" class="form-control" placeholder="Contrase&ntilde;a" id="contrasena"
                               maxlength="40"
                               onkeyup="Estacion.mensajes.oculta($('#contrasena_vacio'));
                                        Estacion.mensajes.oculta($('#contrasena_error'));
                                        Estacion.mensajes.oculta($('#usuario_contrasena_incorrecta'));
                                        Login.index.pressEnter(event)">
                    </div>
                    <div class="mensaje text-center oculto">
                        <label class="control-label" for="contrasena" id="contrasena_vacio">&iexcl;Ingrese contrase&ntilde;a!</label>
                    </div>
                    <div class="mensaje text-center oculto">
                        <label class="control-label" for="contrasena" id="contrasena_error">&iexcl;La contrase&ntilde;a
                            debe contener al
                            menos 8 caracteres!</label>
                    </div>
                </div>
                <div class="agrupador">
                    <div class="mensaje text-center oculto espacioArriba">
                        <label class="control-label" for="usuario" id="usuario_contrasena_incorrecta">&iexcl;Usuario o
                            contrase&ntilde;a
                            incorrecta!</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-xs-offset-4 text-center">
            <div class="form-group">
                <div id="boton_ingresar">
                    <button class="btn btn-primary" onclick="Login.index.validarUsuario()">Ingresar</button>
                </div>
            </div>
        </div>
    </div>

</div>
