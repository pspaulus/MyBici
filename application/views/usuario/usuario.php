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

    <!-- Busqueda -->
    <div class="row">
        <div class="form-inline">
            <div class="col-xs-4 col-sm-2">
                <select class="form-control" id="filtro_usuario">
                    <option value="1">ID</option>
                    <option value="2" selected>Login</option>
                </select>
            </div>
            <div class="col-xs-8 col-sm-8">
                <div class="form-group input-group">
                    <input type="text" class="form-control" id="valor_a_buscar" maxlength="40" onkeyup="Usuario.acciones.pressEnter(event)">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" onclick="Usuario.acciones.buscar();"><i
                                    class="fa fa-search"></i></button>
                        </span>
                </div>
            </div>
        </div>
    </div>
    <!-- check inactivos -->
    <div class="row">
        <div class="col-xs-12">
            <div class="checkbox">
                <label>
                    <small>
                        <input id="verInactivos" type="checkbox" onchange="Usuario.acciones.verInactivos();">Ver
                    Inactivos
                    </small>
                </label>
            </div>
        </div>
    </div>
</div>

    <h3>Lista de Usuarios</h3>
<div class="row">
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
                            <?php if (!($obj_usuario->nombre == 'administrador')){ ?>

                                <?php if (false){ ?>
                                <button class="btn btn-sm btn-default" type="button" data-toggle="modal"
                                        data-target="#verUsuario_<?= $obj_usuario->id ?>"><i
                                        class="fa fa-search"></i></button>
                                    <?php }?>

                                <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" title="Editar"
                                        data-target="#editarUsuario_<?= $obj_usuario->id ?>"><i
                                        class="fa fa-edit"></i></button>

                                <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" title="Eliminar"
                                        data-target="#eliminarUsuario_<?= $obj_usuario->id ?>"><i
                                        class="fa fa-trash"></i></button>

                                <button class="btn btn-sm btn-default oculto" type="button" title="Restaurar"
                                        onclick="Usuario.acciones.restaurar(<?= $obj_usuario->id ?>)">
                                        <i class="fa fa-refresh"></i></button>

                                <!--Modal Eliminar-->
                                <?php $Usuario->load->view('usuario/eliminar', compact('obj_usuario')); ?>

                                <!-- ver modal-->
                                <?php //$Usuario->load->view('usuario/ver', compact('obj_usuario')); ?>

                                <!-- Editar modal-->
                                <?php $Usuario->load->view('usuario/editar', compact('obj_usuario')); ?>
                            <?php }?>
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

