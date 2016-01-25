<?php $Estacion = new Estacion(); ?>
<?php $Estado = new Estado(); ?>
<?php $Ticket = new Ticket(); ?>

<!-- mensajes flotantes-->
<?php Escritorio::Mensaje('guardar_ok', 'ticket') ?>

<!-- Titulo -->
<div class="row" id="page_ticket">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-ticket"></i> Tickets
            <a class="dedo" data-toggle="modal" data-target="#crearTicket"> <i class="fa fa-plus-circle"></i> </a>
            <small class="pull-right" id="total_ticket" style="padding-top: 10px">
                Total Hoy: <?= $Ticket->contarTicketHoy(); ?>
            </small>
        </h1>
    </div>
</div>

<!-- Subtitulo -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#resumen_ticket'), $('#titulo'))">
                    <i class="fa fa-calendar"></i> Tablero de Estados
                </a>
                &nbsp;
                <!--<small class="pull-right">Hoy: --><?//= Escritorio::getFechaEcuador() ?><!--</small>-->
                <button class="btn btn-xs btn-default pull-right" type="button"
                        onclick="Ticket.acciones.RecargarResumen();"><i class="fa fa-refresh">&nbsp;</i></button>
            </li>
        </ol>
    </div>
</div>

<!--Resumen-->
<div id="resumen_ticket">
    <?php $Ticket->load->view('reserva/resumen', compact('Ticket')); ?>
</div>

<!-- Modal Agregar bicicleta -->
<?php $Ticket->load->view('reserva/crear', compact('Ticket')); ?>

<!--Buscar-->
<div class="row" id="listado_busqueda">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo3">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo3'))">
                    <i class="fa fa-search"></i> Buscar
                </a>
            </li>
        </ol>
    </div>
</div>


<div id="contenido_buscar">

    <!-- Tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#por_codigo" data-toggle="tab" role="tab">Por Unidad</a>
        </li>
        <!-- DESACTIVADO TAB USUARIO -->
        <!--                <li role="presentation">-->
        <!--                    <a href="#por_usuario" data-toggle="tab" role="tab">Por Usuario</a>-->
        <!--                </li>-->
        <li role="presentation">
            <a href="#por_estacion" data-toggle="tab" role="tab">Por Lote</a>
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
                        <div class="form-group espacio" style="vertical-align: top">
                            <!--                                    <label class="control-label" for="ticket_campo">Identificador</label>-->
                            <select class="form-control" id="ticket_campo"
                                    onchange="Ticket.acciones.cambiarValorPlaceholder()">
                                <option value="id">Ticket ID</option>
                                <option value="bicicleta">Bicicleta</option>
                                <option value="usuario">Usuario</option>
                            </select>
                        </div>

                        <!--Codigo-->
                        <div class="form-group espacio" style="vertical-align: top">

                            <div class="agrupador">
                                <input type="text" class="form-control" id="ticket_valor" maxlength="45"
                                       onkeyup="Ticket.acciones.pressEnter(event);Estacion.mensajes.oculta($('#error_no_valor'));">

                                <div class=" mensaje oculto">
                                    <label class="control-label" id="error_no_valor">&iexcl;Ingrese valor a
                                        buscar!</label>
                                </div>
                                <script>
                                    Ticket.acciones.cambiarValorPlaceholder();
                                </script>
                            </div>
                        </div>

                        <!--Boton buscar-->
                        <div class="form-group" style="vertical-align: top">
                            <button class="btn btn-primary" type="button" id="btn_buscar"
                                    onclick="Ticket.acciones.cargarListaTicketPorCampo()"><i
                                    class="fa fa-search"></i></button>
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
                                   for="select_ticket_estacion">Destino</label>
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
                            <select id="select_estado_ticket" class="form-control">
                                <option value="-1">Todas</option>
                                <?php foreach ($estados_bicicletas as $estado) { ?>
                                    <option
                                        value="<?= $estado->id ?>"><?= $estado->descripcion ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!--fecha-->
                        <div class="form-group espacio">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="filtro_fecha"
                                       readonly value="<?= Escritorio::getFechaEcuador() ?>">
                            </div>
                        </div>
                        <script>
                            $('#filtro_fecha').datepicker({
                                format: "yyyy-mm-dd",
                                autoclose: true,
                                todayBtn: "linked",
                                language: "es",
                                orientation: "top right",
                                todayHighlight: true
                            });
                        </script>

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
</div>
<div id="listado_ticket">
    <h3>Lista de Tickets</h3>

    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Bicicleta</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Hora Retiro</th>
                    <th>Hora Entrega</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
