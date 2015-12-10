<?php $Persona = new Persona();?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!--Titulo-->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-fw fa-users"></i> Usuarios
                </h1>
            </div>
        </div>

        <!--Subtitulo-->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-plus"></i> Agregar
                    </li>
                </ol>
            </div>
        </div>

        <!-- Button trigger modal agregar -->
        <div class="row form-control-espacio">
            <div class="col-lg-12">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarMarca" ><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <!-- Modal Agregar-->
        <div class="modal fade" id="agregarMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                        <input class="form-control" type="text" placeholder="" value="<?=  $Persona->cargarUltimoId() ?>" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label for="Descripcion">Nombre</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control" id="nombre" type="text" maxlength="16" placeholder="Ingrese un nombre" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label for="Descripcion">Contrase&ntilde;a</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control" id="contrasena" type="password" maxlength="16" placeholder="Ingrese una contrase&ntilde;a" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label for="Descripcion">Confirme Contrase&ntilde;a</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control" id="confirmar_contrasena" type="password" maxlength="16" placeholder="repita la contrase&ntilde;a" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label>Estado</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="form-control">
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                        </div>

                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Usuario.acciones.limpiar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="Usuario.acciones.guardar()" data-dismiss="modal">Guardar</button>
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

        <div class="row">
            <div class="col-lg-12 text-right">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="">Incluir Inactivos
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                <select class="form-control">
                    <option>ID</option>
                    <option>Login</option>
                </select>
            </div>
            <div class="col-xs-8">

                <div class="form-group input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                </div>
            </div>

            <div class="col-xs-12">
                <?php

                        $collection_usuario = $Persona->cargarUsuariosTodos(true);
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Login</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($collection_usuario as $obj_usuario){
                        ?>
                        <tr>
                            <td><?= $obj_usuario->id ?></td>
                            <td><?= $obj_usuario->nombre ?></td>
                            <td><?= ($obj_usuario->ESTADO_id == 1)? 'Activo' : 'Inactivo' ?></td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
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
                            </td>

                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>