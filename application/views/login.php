<div class="container" id="formLogin">

    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <div class="form-group">
                <h1 class="page-header text-center text-color-white">
                    <i class="fa fa-fw fa-key"></i> Login
                </h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <div class="form-group">
                <div class="agrupador">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-user"></i>&nbsp;</div>
                        <input type="text" class="form-control" placeholder="Usuario" id="usuario" maxlength="40"
                               onkeyup="Login.index.validarNumeroCaracteres(this,4)">
                    </div>
                    <label class="control-label vacio oculto" for="usuario" id="usuario_vacio">&iexcl;Ingrese
                        usuario!</label>
                    <label class="control-label error oculto" for="usuario" id="usuario_error">&iexcl;El usuario debe contener al menos 4 caracteres!</label>
                </div>

                <div class="agrupador">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i>&nbsp;</div>
                        <input type="password" class="form-control" placeholder="Contrase&ntilde;a" id="contrasena" maxlength="40" onkeyup="Login.index.validarNumeroCaracteres(this,8)">
                    </div>
                    <label class="control-label vacio oculto" for="contrasena" id="contrasena_vacio">&iexcl;Ingrese
                        contrase&ntilde;a!</label>
                    <label class="control-label error oculto" for="usuario" id="contrasena_error">&iexcl;La contrase&ntilde;a debe contener al menos 8 caracteres!</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-xs-offset-4 text-center">
            <div class="form-group">
                <button class="btn bg-color-green " onclick="Login.index.validarUsuario()">Ingresar</button>
            </div>
        </div>
    </div>

</div>
