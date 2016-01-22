<?php /** @var Usuario $Usuario */ ?>

<div class="table-responsive">
    <table id="tabla_usuario" class="table table-hover">
        <thead>
        <tr>
            <th>Nro.</th>
            <th>Login</th>
            <th>ID</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th class="text-center">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1 ?>
        <?php $collection_usuario = $Usuario->cargarUsuariosTodos($filtro, $valor_a_buscar, $ver_inactivos, $tdu); ?>
        <?php if (count($collection_usuario) == 0) {
            $Usuario->load->view('sin_datos');
        } else { ?>
            <?php foreach ($collection_usuario as $obj_usuario) { ?>
                <tr class="<?= ($obj_usuario->ESTADO_id == 1) ? 'activo' : 'inactivo' ?>">
                    <td><strong><?= $i ?></strong></td>
                    <?php $i++ ?>
                    <?php $usuario_nombre = $obj_usuario->nombre ?>
                    <td><i class="fa fa-user"></i> <strong><?= $usuario_nombre ?></strong></td>
                    <td><?= $obj_usuario->id ?></td>
                    <?php switch ($obj_usuario->TIPO_id) {
                        case 2:
                            $usuario_tipo = 'Est&aacute;ndar';
                            break;
                        case 1:
                            $usuario_tipo = 'Administrador';
                            break;
                        case 8:
                            $usuario_tipo = 'Operario';
                            break;
                    } ?>
                    <td><?= $usuario_tipo ?></td>
                    <td><?= ($obj_usuario->ESTADO_id == 1) ? 'Activo' : 'Inactivo' ?></td>

                    <td class="text-center">

                        <!-- quitar funcion ver -->
                        <?php if (false) { ?>
                            <button class="btn btn-sm btn-default" type="button" data-toggle="modal"
                                    data-target="#verUsuario_<?= $obj_usuario->id ?>"><i
                                    class="fa fa-search"></i></button>
                        <?php } ?>

                        <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" title="Editar"
                                data-target="#editarUsuario_<?= $obj_usuario->id ?>"><i
                                class="fa fa-edit"></i></button>

                        <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" title="Eliminar"
                                data-target="#eliminarUsuario_<?= $obj_usuario->id ?>"><i
                                class="fa fa-trash"></i></button>

                        <?php if ($obj_usuario->ESTADO_id == 2) { ?>
                            <button class="btn btn-sm btn-default" type="button" title="Restaurar"
                                    onclick="Usuario.acciones.restaurar(<?= $obj_usuario->id ?>)">
                                <i class="fa fa-refresh"></i></button>
                        <?php } ?>
                    </td>
                    <td>
                        <!--Modal Eliminar-->
                        <?php $Usuario->load->view('usuario/eliminar', compact('obj_usuario','usuario_nombre')); ?>

                        <!-- ver modal-->
                        <?php //$Usuario->load->view('usuario/ver', compact('obj_usuario')); ?>

                        <!-- Editar modal-->
                        <?php $Usuario->cagarVistaEditar($tdu); ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>

        <script>
            Usuario.acciones.verInactivos();
        </script>

        </tbody>
    </table>
    <div class="tip text-center espacioAbajoFijo">
        <small>
            <a href="#listado_busqueda" class="dedo">Ir al inicio</a>
        </small>
    </div>
</div>