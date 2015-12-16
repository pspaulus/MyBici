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
            </div>
        </div>

        <?php $estaciones = $Estacion->cargarEstaciones() ?>
        <div class="row">
            <div class="col-xs-5">
                <select class="form-control form-group">
                    <?php foreach ($estaciones as $estacion) { ?>
                        <option value="<?= $estacion->id ?>"><?= $estacion->nombre ?></option>
                    <?php } ?>
                </select>
            </div>
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
                <div id="contentVideo4" class="tab-content tab-contenido">

                    <div role="tabpanel" class="tab-pane fade in active" id="parqueos">
                        <!-- tab parqueos -->
                        <?php $Estacion->load->view('estacion/parqueos', compact('Estacion')); ?>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="datos">
                        <!-- tab datos -->
                        <?php $Estacion->load->view('estacion/datos'); ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

