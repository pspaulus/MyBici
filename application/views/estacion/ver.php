<?php $Estacion = new Estacion(); ?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Titulo -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-fw fa-map-marker"></i> Estaciones
                </h1>
            </div>
        </div>

        <!-- Subtitulo -->
        <a onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_agregar'), $('#titulo'))">
            <div class="row">
                <div class="col-xs-12">
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
            <!-- Button trigger modal crear -->
            <div class="row form-control-espacio ">
                <div class="col-xs-12">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#crearEstacion"><i
                            class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>

        <!-- Modal Agregar -->
        <?php $Estacion->load->view('estacion/crear', compact('Estacion')); ?>

        <a onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo2'))">
            <!-- Subtitulo -->
            <div class="row" id="listado_busqueda">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active" id="titulo2">
                            <i class="fa fa-search"></i> Buscar
                        </li>
                    </ol>
                </div>
            </div>
        </a>

        <div id="contenido_buscar">

            <!--Form buscar-->
            <div class="row">
                <div class="form-inline">
                    <div class="col-xs-12">

                        <!--Select Estacion-->
                        <div class="form-group espacio">
                            <?php $estaciones = $Estacion->cargarEstaciones() ?>
                            <label class="control-label" for="select_estacion">Nombre</label>
                            <select id="select_estacion" class="form-control"
                                    onchange="Estacion.acciones.cargarDatosEstacion()">
                                <?php foreach ($estaciones as $estacion) { ?>
                                    <option
                                        value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                                <?php } ?>
                            </select>
                            <div class="agrupador">
                                <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                                    <label class="control-label" id="error_sin_estacion">&iexcl;No hay estaci&oacute;n!</label>
                                </div>
                            </div>
                        </div>

                        <!--Select Estado Parqueo-->
                        <div class="form-group espacio busqueda">
                            <label class="control-label" for="filtro_estado_parqueo">Estado</label>
                            <select class="form-control" id="filtro_estado_parqueo">
                                <option value="todos" selected>Todos</option>
                                <option value="ocupados">Ocupados</option>
                                <option value="libres">Libres</option>
                            </select>
                        </div>

                        <!-- Button buscar lista parqueo -->
                        <div class="form-group espacio busqueda">
                            <button class="btn btn-primary" type="button"
                                    onclick="Estacionamiento.acciones.cargarListaParqueos()">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <!--Espacio-->
            <div class="row">
                <div class="col-xs-12">&nbsp;</div>
            </div>

            <!-- Tabs -->
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#parqueos" data-toggle="tab" role="tab"
                               onclick="Estacion.acciones.busqueda('mostrar');">Estacionamientos</a>
                        </li>
                        <li role="presentation">
                            <a href="#datos_estacion" data-toggle="tab" role="tab"
                               onclick="Estacion.acciones.busqueda('ocultar');">Datos B&aacute;sicos</a>
                        </li>
                    </ul>

                    <!-- Tab panels -->
                    <div id="" class="tab-content tab-contenido">

                        <div role="tabpanel" class="tab-pane fade in active" id="parqueos">
                            <!-- tab parqueos -->
                            <!-- se llena por ajax -->
                            <div class="col-xs-12">
                                <h3>Lista de Estacionamiento</h3>

                                <div class="table-responsive">
                                    <table id="tabla_usuario" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nro.</th>
                                            <th>Codigo</th>
                                            <th>Bicicleta</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="datos_estacion">
                            <script>
                                Estacion.acciones.cargarDatosEstacion();
                            </script>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>