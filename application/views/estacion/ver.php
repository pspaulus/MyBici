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
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-plus"></i> Agregar
                    </li>
                </ol>
            </div>
        </div>

        <!-- Button trigger modal crear -->
        <div class="row form-control-espacio">
            <div class="col-lg-12">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#crearEstacion"><i
                        class="fa fa-plus"></i></button>
            </div>
        </div>

        <!-- Modal Agregar -->
        <?php $Estacion->load->view('estacion/crear', compact('Estacion')); ?>

        <!-- Subtitulo -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-search"></i> Buscar
                    </li>
                </ol>
                <h3>Parqueos</h3>
            </div>
        </div>

        <!--Form buscar-->
        <div class="row">
            <div class="form-inline">
                <div class="col-xs-12">

                    <!--Select Estacion-->
                    <div class="form-group espacio">
                        <?php $estaciones = $Estacion->cargarEstaciones() ?>
                        <label class="control-label" for="select_estacion">Nombre</label>
                        <select id="select_estacion" class="form-control">
                            <?php foreach ($estaciones as $estacion) { ?>
                                <option
                                    value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!--Select Estado Parqueo-->
                    <div class="form-group espacio">
                        <label class="control-label" for="filtro_estado_parqueo">Estado</label>
                        <select class="form-control" id="filtro_estado_parqueo">
                            <option value="todos" selected>Todos</option>
                            <option value="ocupados">Ocupados</option>
                            <option value="libres">Libres</option>
                        </select>
                    </div>

                    <!-- Button buscar lista parqueo -->
                    <div class="form-group espacio">
                        <button class="btn btn-primary" type="button" onclick="Estacion.acciones.cargarListaParqueos()">
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

            <div class="row">
                <div class="col-xs-12">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#parqueos" data-toggle="tab" role="tab">Parqueos</a>
                        </li>
                        <li role="presentation">
                            <a href="#datos" data-toggle="tab" role="tab">Datos B&aacute;sicos</a>
                        </li>
                    </ul>

                    <!-- Tab panels -->
                    <div id="" class="tab-content tab-contenido">

                        <div role="tabpanel" class="tab-pane fade in active" id="parqueos">
                            <!-- tab parqueos -->
                            <!-- se llena por ajax -->
                            <div class="col-xs-12">
                                <h3>Lista de parqueos</h3>

                                <div class="table-responsive">
                                    <table id="tabla_usuario" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>N&uacute;mero</th>
                                            <th>Cod. Bicicleta</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="datos">
                            <!-- tab datos -->
                            <?php $Estacion->load->view('estacion/datos'); ?>
                        </div>
                    </div>

                </div>
            </div>



    </div>

