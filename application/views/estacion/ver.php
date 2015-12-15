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

        <div class="row">

            <!-- Tabs -->
            <ul id="tabVideo4" class="nav nav-tabs" role="tablist">
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
                    <?php $Estacion->load->view('estacion/parqueos'); ?>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="datos">
                    <!-- tab datos -->
                    <?php $Estacion->load->view('estacion/datos'); ?>
                </div>
            </div>
        </div>



    </div>
</div>

