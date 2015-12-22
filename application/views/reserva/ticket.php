<?php $Estacion = new Estacion(); ?>
<?php $Estado = new Estado(); ?>
<?php $Ticket = new Ticket(); ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Titulo -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-fw fa-ticket"></i> Reservas
                    <small> Total: <?= $Ticket->contarTicketHoy(); ?></small>
                </h1>
            </div>
        </div>

        <!-- Subtitulo -->
        <a onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_resumen'), $('#titulo'))">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active" id="titulo">
                            <i class="fa fa-clock-o"></i> Hoy: <?= date('Y-m-d'); ?>
                            <button class="btn btn-xs btn-default" type="button"
                                    onclick="Ticket.acciones.refrescar();"><i class="fa fa-refresh"></i></button>
                        </li>
                    </ol>
                </div>
            </div>
        </a>

        <!--Resumen-->
        <div id="contenido_resumen">
            <?php $Ticket->load->view('reserva/resumen', compact('Ticket')); ?>
        </div>

        <a onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_agregar'), $('#titulo2'))">
            <!--Agregar-->
            <div class="row">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active" id="titulo2">
                            <i class="fa fa-plus-circle"></i> Agregar
                        </li>
                    </ol>
                </div>
            </div>
        </a>
        <script>
            Escritorio.Acciones.ocultarMostrar($('#contenido_agregar'), $('#titulo2'));
        </script>

        <div id="contenido_agregar">
            <!-- Button trigger modal agregar bicicleta-->
            <div class="row form-control-espacio">
                <div class="col-lg-12">
                    <button class="btn btn-primary" type="button" title="Agregar bicicleta" data-toggle="modal"
                            data-target="#crearTicket"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <!-- Modal Agregar bicicleta -->
            <?php $Ticket->load->view('reserva/crear', compact('Ticket')); ?>
        </div>

        <!--Buscar-->
        <a onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo3'))">
            <div class="row">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active" id="titulo3">
                            <i class="fa fa-search"></i> Buscar
                        </li>
                    </ol>
                </div>
            </div>
        </a>

        <div id="contenido_buscar">

            <!-- Tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#por_codigo" data-toggle="tab" role="tab">Por C&oacute;digo</a>
                </li>
                <li role="presentation">
                    <a href="#por_estacion" data-toggle="tab" role="tab">Por Estaci&oacute;n</a>
                </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content tab-contenido">

                <!--Por codigo-->
                <div role="tabpanel" class="tab-pane fade in active" id="por_codigo">

                    <!--Espacio-->
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="form-inline">
                            <div class="col-xs-12">

                                <!--Identificador-->
                                <div class="col-xs-3">
                                    <select class="form-control" id="ticket_buscar_tipo">
                                        <option value="id">ID</option>
                                        <option value="usuario">Usuario</option>
                                        <option value="bicicleta">C&oacute;digo Bicicleta</option>
                                    </select>
                                </div>

                                <!--Codigo-->
                                <div class="form-group espacio">
                                    <div class="agrupador">
                                        <label class="control-label" for="ticket_codigo">C&oacute;digo</label>
                                        <input type="text" class="form-control" id="ticket_valor" maxlength="45"
                                               onkeyup="Estacion.mensajes.oculta($('#error_no_valor'));">
                                        <!--Boton buscar-->
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="button"
                                                    onclick="Ticket.acciones.buscar()"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                        <div class="col-xs-12 col-xs-offset-1 mensaje oculto">
                                            <label class="control-label" id="error_no_valor">&iexcl;Ingrese valor a
                                                buscar!</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--Por Estacion-->
                <div role="tabpanel" class="tab-pane fade" id="por_estacion">

                    <!--Espacio-->
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="form-inline">
                            <div class="col-xs-12">

                                <!--Select Estacion-->
                                <div class="form-group espacio">
                                    <?php $estaciones = $Estacion->cargarEstaciones() ?>
                                    <label class="control-label"
                                           for="select_ticket_estacion">Estaci&oacute;n</label>
                                    <select id="select_ticket_estacion" class="form-control">
                                        <option value="-1">Todas</option>
                                        <?php foreach ($estaciones as $estacion) { ?>
                                            <option
                                                value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!--Select Estado-->
                                <div class="form-group espacio">
                                    <?php $estados_bicicletas = $Estado->getEstadoTickets(); ?>
                                    <label class="control-label" for="select_ticket_estado">Estado</label>
                                    <select id="select_estado_inventario" class="form-control">
                                        <option value="-1">Todas</option>
                                        <?php foreach ($estados_bicicletas as $estado) { ?>
                                            <option
                                                value="<?= $estado->id ?>"><?= $estado->descripcion ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!--Boton buscar-->
                                <div class="form-group">
                                    <button class="btn btn-primary" type="button"
                                            onclick="Ticket.acciones.cargarListaTicketPorEstacion()"><i
                                            class="fa fa-search"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Espacio-->
            <div class="row">
                <div class="col-xs-12">&nbsp;</div>
            </div>

            <div id="listado_ticket">
                <h3>Lista de Tickets</h3>

                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Completo</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>