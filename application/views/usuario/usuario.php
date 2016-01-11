<?php $Usuario = new Usuario(); ?>
<div class="col-xs-12">
    <!-- mensajes flotantes-->
    <?php Escritorio::Mensaje('guardar_ok', 'usuario') ?>
    <?php Escritorio::Mensaje('eliminar_ok', 'usuario') ?>
    <?php Escritorio::Mensaje('editar_ok', 'usuario') ?>
    <?php Escritorio::Mensaje('restaurar_ok', 'usuario') ?>
    <?php Escritorio::Mensaje('error', 'usuario') ?>
</div>
<!-- Titulo -->
<div class="row" id="page_usuario">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-users"></i> Usuarios
            <!-- Agregar -->
            <a class="dedo" data-toggle="modal" data-target="#agregarUsuario"> <i class="fa fa-plus-circle"></i> </a>
        </h1>
    </div>
</div>

<?php $Usuario->load->view('usuario/crear', compact('Usuario')); ?>

<!-- Subtitulo -->
<div class="row" id="listado_busqueda">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo2">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo2'))">
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

            <!-- filtro -->
            <div class="col-xs-4 col-sm-2 col-lg-1">
                <select class="form-control" id="filtro_usuario">
                    <option value="nombre">Login</option>
                    <option value="id">ID</option>
                </select>
            </div>

            <!-- valor -->
            <div class="col-xs-8 col-sm-8 espacioRelleno">
                <div class="form-group input-group">
                    <input type="text" class="form-control" id="valor_a_buscar" maxlength="40"
                           onkeyup="Usuario.acciones.pressEnter(event)">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button"
                                    onclick="Usuario.acciones.cargarVistaListaUsuario()"><i class="fa fa-search"></i>
                            </button>
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
                        <input id="verInactivos" type="checkbox"
                               onchange="Usuario.acciones.cargarVistaListaUsuario();">Ver Inactivos
                    </small>
                </label>
            </div>
        </div>
    </div>
</div>

<h3>Lista de Usuarios</h3>
<div class="row">
    <div class="col-xs-12">
        <div id="listado_usuario"></div>
    </div>
</div>

<script>
    Usuario.acciones.cargarVistaListaUsuario();
</script>

