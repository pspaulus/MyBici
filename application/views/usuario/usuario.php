<?php $Usuario = new Usuario(); ?>

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

        <!-- crear -->
        <a onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_agregar'), $('#titulo'))">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active" id="titulo">
                            <i class="fa fa-plus-circle"></i> Agregar
                        </li>
                    </ol>
                </div>
            </div>
        </a>
        <script>
            Escritorio.Acciones.ocultarMostrar($('#contenido_agregar'), $('#titulo'));
        </script>

        <div id="contenido_agregar">
            <!-- Button trigger modal agregar -->
            <div class="row form-control-espacio">
                <div class="col-lg-12">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarUsuario"><i
                            class="fa fa-plus"></i></button>
                </div>
            </div>

            <!-- Modal Agregar -->
            <?php $Usuario->load->view('usuario/crear', compact('Usuario')); ?>
        </div>

        <a onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo2'))">
            <!-- Subtitulo -->
            <div class="row">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active" id="titulo2">
                            <i class="fa fa-search"></i> Buscar
                        </li>
                    </ol>
                </div>
            </div>
        </a>

        <div id="contenido_buscar">
            <h3>Lista de Usuario</h3>
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
                    <?php $collection_usuario = $Usuario->cargarUsuariosTodos(true); ?>

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
                                <tr class="<?= ($obj_usuario->ESTADO_id == 1) ? 'activo success' : 'inactivo danger' ?>">
                                    <td><?= $obj_usuario->id ?></td>
                                    <td><strong><?= $obj_usuario->nombre ?></strong></td>
                                    <td><?= ($obj_usuario->TIPO_id == 2) ? 'Est&aacute;ndar' : 'Administrador' ?></td>
                                    <td><?= ($obj_usuario->ESTADO_id == 1) ? 'Activo' : 'Inactivo' ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-default" type="button" data-toggle="modal"
                                                data-target="#verUsuario_<?= $obj_usuario->id ?>"><i
                                                class="fa fa-search"></i></button>
                                        <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                                data-target="#editarUsuario_<?= $obj_usuario->id ?>"><i
                                                class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" type="button" data-toggle="modal"
                                                data-target="#eliminarUsuario_<?= $obj_usuario->id ?>"><i
                                                class="fa fa-trash"></i></button>

                                        <!--Modal Eliminar-->
                                        <?php $Usuario->load->view('usuario/eliminar', compact('obj_usuario')); ?>

                                        <!-- ver modal-->
                                        <?php $Usuario->load->view('usuario/ver', compact('obj_usuario')); ?>

                                        <!-- Editar modal-->
                                        <?php $Usuario->load->view('usuario/editar', compact('obj_usuario')); ?>
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
</div>

