<?php $Persona = new Persona();?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Titulo -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-fw fa-users"></i> Usuarios
                </h1>
            </div>
        </div>

        <!-- Subtitulo -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active ">
                        <i class="fa fa-plus"></i> Agregar
                    </li>
                </ol>
            </div>
        </div>

        <!-- Button trigger modal agregar -->
        <div class="row form-control-espacio">
            <div class="col-lg-12">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarUsuario" ><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <!-- Modal Agregar-->
        <div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="form_usuario">
                        <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label>ID</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control" type="text" placeholder="" value="<?= $Persona->cargarUltimoId() ?>" disabled="">
                                    </div>
                                </div>
                                <div class="agrupador">
                                    <div class="form-group">
                                        <div class="col-xs-2 col-xs-offset-1">
                                            <label for="Descripcion">Login</label>
                                        </div>
                                        <div class="col-xs-6 mensaje">
                                            <input class="form-control" id="nombre" type="text" maxlength="40" placeholder="Ingrese un nombre" value="" onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,4)">
                                            <label class="control-label vacio oculto" for="nombre" id="nombre_vacio">&iexcl;Ingrese usuario!</label>
                                            <label class="control-label error oculto" for="nombre" id="nombre_error">&iexcl;El usuario debe contener al menos 4 caracteres!</label>
                                        </div>
                                    </div>
                                 </div>
                                <div class="agrupador">
                                    <div class="form-group">
                                        <div class="col-xs-2 col-xs-offset-1">
                                            <label for="Descripcion">Contrase&ntilde;a</label>
                                        </div>
                                        <div class="col-xs-6 mensaje">
                                            <input class="form-control" id="contrasena" type="password" maxlength="40" placeholder="Ingrese una contrase&ntilde;a" value="" onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8)">
                                            <label class="control-label vacio oculto" for="contrasena" id="contrasena_vacio">&iexcl;Ingrese contrase&ntilde;a!</label>
                                            <label class="control-label error oculto" for="contrasena" id="contrasena_error">&iexcl;La contrase&ntilde;a debe contener al menos 8 caracteres!</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="agrupador">
                                    <div class="form-group">
                                        <div class="col-xs-2 col-xs-offset-1">
                                            <label for="Descripcion">Confirmar Contrase&ntilde;a</label>
                                        </div>
                                        <div class="col-xs-6 mensaje">
                                            <input class="form-control" id="confirmar_contrasena" type="password" maxlength="40" placeholder="repita la contrase&ntilde;a" value="" onkeyup="Usuario.acciones.validarNumeroCaracteresUsuario(this,8)">
                                            <label class="control-label vacio oculto" for="confirmar_contrasena" id="confirmar_contrasena_vacio">&iexcl;Ingrese confirmaci&oacute;n de contrase&ntilde;a!</label>
                                            <label class="control-label error oculto" for="confirmar_contrasena" id="confirmar_contrasena_error">&iexcl;La confirmaci&oacute;n de contrase&ntilde;a debe contener al menos 8 caracteres!</label>
                                            <div class="has-error">
                                            <label class="control-label oculto" for="confirmar_contrasena" id="contrasena_no_coinciden">&iexcl;Las contrase&ntilde;as no coinciden!</label>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Usuario.acciones.limpiar()">Cancelar</button>
<!--                        <button type="button" class="btn btn-primary" onclick="Usuario.acciones.guardar();" data-dismiss="modal">Guardar</button>-->
                        <button type="button" class="btn btn-primary" onclick="Usuario.acciones.guardar();" >Guardar</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Subtitulo -->
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-search"></i> Buscar
                    </li>
                </ol>
            </div>
        </div>

        <!-- check inactivos -->
        <div class="row">
            <div class="col-lg-12 text-right">
                <div class="checkbox">
                    <label>
                        <input id="verInactivos" type="checkbox" onchange="Usuario.acciones.verInactivos();">Ver Inactivos
                    </label>
                </div>
            </div>
        </div>

        <!-- Busqueda -->
        <div class="row">
            <div class="col-xs-4 col-sm-2  col-md-offset-7">
                <select class="form-control" id="filtro_usuario">
                    <option value="1">ID</option>
                    <option value="2" selected>Login</option>
                </select>
            </div>
            <div class="col-xs-8 col-sm-3">
                <div class="form-group input-group">
                    <span class="input-group-btn"><button class="btn btn-default" type="button" onclick="Usuario.acciones.buscar();"><i class="fa fa-search"></i></button></span>
                    <input type="text" class="form-control" id="valor_a_buscar" onkeyup="Usuario.acciones.buscar();" maxlength="40">
                </div>
            </div>

            <div class="col-xs-12">
                <?php $collection_usuario = $Persona->cargarUsuariosTodos(true); ?>

                <div class="table-responsive">
                    <table id="tabla_usuario" class="table  table-hover">
                        <thead>
                        <tr >
                            <th>ID</th>
                            <th>Login</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($collection_usuario as $obj_usuario){
                        ?>
                        <tr class="<?= ($obj_usuario->ESTADO_id == 1)? 'activo ' : 'inactivo '?>">
                            <td><?= $obj_usuario->id ?></td>
                            <td><?= $obj_usuario->nombre ?></td>
                            <td><?= ($obj_usuario->TIPO_id == 2)? 'Est&aacute;ndar' : 'Administrador' ?></td>
                            <td><?= ($obj_usuario->ESTADO_id == 1)? 'Activo' : 'Inactivo' ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-default" type="button" data-toggle="modal" data-target="#verUsuario_<?= $obj_usuario->id ?>"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-toggle="modal" data-target="#editarUsuario_<?= $obj_usuario->id ?>"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#eliminarUsuario_<?= $obj_usuario->id ?>"><i class="fa fa-trash"></i></button>

                                <!--Modal Eliminar-->
                                <div class="modal fade bs-example-modal-sm" id="eliminarUsuario_<?= $obj_usuario->id ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                &iquest;Est&aacute; seguro eliminar?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                <button type="button" class="btn btn-primary" onclick="Usuario.acciones.eliminar(<?= $obj_usuario->id ?>)" data-dismiss="modal">Si</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ver modal-->
                                <div class="modal fade" id="verUsuario_<?= $obj_usuario->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title text-left" id="myModalLabel">Ver Usuario</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" id="form_usuario">
                                                    <div class="row">

                                                        <div class="form-group">
                                                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                                                <label>ID</label>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <input class="form-control" type="text" placeholder="" value="<?= $obj_usuario->id ?>" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                                                <label for="Descripcion">Nombre</label>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <input class="form-control" id="nombre_ver" type="text" maxlength="40" placeholder="Ingrese un nombre" value="<?= $obj_usuario->nombre ?>" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                                                <label for="Descripcion">Contrase&ntilde;a</label>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <input class="form-control" id="contrasena_ver" type="password" maxlength="40" placeholder="Ingrese una contrase&ntilde;a" value="<?= $obj_usuario->contrasena ?>" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="col-xs-2 col-xs-offset-1 text-left">
                                                                <label>Tipo</label>
                                                            </div>
                                                            <div class="col-xs-6" id="estado" >
                                                                <select class="form-control" id="tipo_usuario" disabled="">
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

                                                                <select class="form-control"  id="estado_editar" disabled="">
                                                                    <option value="1" <?= ($obj_usuario->ESTADO_id == 1)? 'selected' : '' ?>>Activo</option>
                                                                    <option value="2" <?= ($obj_usuario->ESTADO_id == 2)? 'selected' : '' ?>>Inactivo</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Editar modal-->
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
                            </td>

                        </tr>
                        <?php }?>

                        <script>
                            Usuario.acciones.verInactivos();
                        </script>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

