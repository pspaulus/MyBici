<?php $Usuario = new Usuario(); ?>

<!-- Titulo -->
<div class="row" id="page_usuario">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-users"></i> Usuarios
        </h1>
    </div>
</div>

<!-- crear -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo">
                <!-- trigger modal agregar -->
                <a class="dedo" data-toggle="modal" data-target="#agregarUsuario">
                    <i class="fa fa-plus-circle"></i> Agregar
                </a>
            </li>
        </ol>
    </div>
</div>

<?php $Usuario->load->view('usuario/crear', compact('Usuario')); ?>

<!-- Subtitulo -->
<div class="row" id="listado_busqueda">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo2">
                <a class="dedo"
                   onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo2'))">
                    <i class="fa fa-search"></i> Buscar
                </a>
            </li>
        </ol>
    </div>
</div>

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
                        <tr class="<?= ($obj_usuario->ESTADO_id == 1) ? 'activo' : 'inactivo' ?>">
                            <td><?= $obj_usuario->id ?></td>
                            <td><i class="fa fa-user"></i> <strong><?= $obj_usuario->nombre ?></strong></td>
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
                <div class="tip text-center">
                    <small>
                        <a href="#listado_busqueda">Ir al inicio</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>


