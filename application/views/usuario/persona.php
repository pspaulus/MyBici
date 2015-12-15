<?php $Persona = new Persona(); ?>

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
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarUsuario"><i
                        class="fa fa-plus"></i></button>
            </div>
        </div>

        <!-- Modal Agregar -->
        <?php $Persona->load->view('usuario/crear', compact('Persona')); ?>

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
                        <input id="verInactivos" type="checkbox" onchange="Usuario.acciones.verInactivos();">Ver
                        Inactivos
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
                    <span class="input-group-btn"><button class="btn btn-default" type="button"
                                                          onclick="Usuario.acciones.buscar();"><i
                                class="fa fa-search"></i></button></span>
                    <input type="text" class="form-control" id="valor_a_buscar" onkeyup="Usuario.acciones.buscar();"
                           maxlength="40">
                </div>
            </div>

            <div class="col-xs-12">
                <?php $collection_usuario = $Persona->cargarUsuariosTodos(true); ?>

                <div class="table-responsive">
                    <table id="tabla_usuario" class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Login</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($collection_usuario as $obj_usuario) { ?>
                            <tr class="<?= ($obj_usuario->ESTADO_id == 1) ? 'activo ' : 'inactivo ' ?>">
                                <td><?= $obj_usuario->id ?></td>
                                <td><?= $obj_usuario->nombre ?></td>
                                <td><?= ($obj_usuario->TIPO_id == 2) ? 'Est&aacute;ndar' : 'Administrador' ?></td>
                                <td><?= ($obj_usuario->ESTADO_id == 1) ? 'Activo' : 'Inactivo' ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-default" type="button" data-toggle="modal"
                                            data-target="#verUsuario_<?= $obj_usuario->id ?>"><i
                                            class="fa fa-search"></i></button>
                                    <button class="btn btn-sm btn-default" type="button" data-toggle="modal"
                                            data-target="#editarUsuario_<?= $obj_usuario->id ?>"><i
                                            class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" type="button" data-toggle="modal"
                                            data-target="#eliminarUsuario_<?= $obj_usuario->id ?>"><i
                                            class="fa fa-trash"></i></button>

                                    <!--Modal Eliminar-->
                                    <?php $Persona->load->view('usuario/eliminar', compact('obj_usuario')); ?>

                                    <!-- ver modal-->
                                    <?php $Persona->load->view('usuario/ver', compact('obj_usuario')); ?>

                                    <!-- Editar modal-->
                                    <?php $Persona->load->view('usuario/editar', compact('obj_usuario')); ?>
                                </td>
                            </tr>
                        <?php } ?>

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

