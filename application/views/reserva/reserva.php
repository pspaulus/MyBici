<?php /** @var Ticket $Ticket */ ?>
<?php /** @var Estacion $Estacion */ ?>
<?php /** @var Estado $Estado */ ?>

<!-- mensajes flotantes-->
<div class="mensajeFlotanteContenedor">
    <?php Escritorio::Mensaje('guardar_ok', 'ticket') ?>
</div>

<!-- Titulo -->
<div class="row" id="page_ticket">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-ticket"></i> Tickets
            <span id="contendor_boton_crear"></span>
            <small class="pull-right" id="total_ticket" style="padding-top: 10px">
                Total Hoy: <?= $Ticket->contarTicketHoy(); ?>
            </small>
        </h1>
    </div>
</div>

<div id="contenedor_div_agregar"></div>
<script>
    Ticket.index.cargarBotonCrear();
</script>


<!-- Subtitulo -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#resumen_ticket'), $('#titulo'))">
                    <i class="fa fa-calendar"></i> Tablero de Estados
                </a>
                &nbsp;
                <?php $estaciones = $Estacion->cargarEstaciones(); ?>
                <select id="select_estacion_resumen" onchange="Ticket.acciones.RecargarResumen();">
                    <option value="-1">Estaci&oacute;n Todas</option>
                    <?php foreach ($estaciones as $estacion) { ?>
                        <option
                            value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                    <?php } ?>
                </select>
                &nbsp;
                <!--<small class="pull-right">Hoy: --><?//= Escritorio::getFechaEcuador() ?><!--</small>-->
                <button class="btn btn-xs btn-default pull-right" type="button"
                        onclick="Ticket.acciones.RecargarResumen();"><i class="fa fa-refresh">&nbsp;</i></button>
            </li>
        </ol>
    </div>
</div>

<!--Resumen-->
<div id="contenedor_resumen"></div>
<script>
    Ticket.acciones.RecargarResumen();
</script>

<!-- Modal Agregar -->
<div id="contenedor_div_crear"></div>
<script>
    Ticket.index.cargarVistaCrear();
</script>

<!--Buscar-->
<div class="row" id="listado_busqueda">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo3">
                <a class="dedo" onclick="Escritorio.Acciones.ocultarMostrar($('#contenido_buscar'), $('#titulo3'))">
                    <i class="fa fa-search"></i> Buscar
                </a>
                &nbsp;
                <label class="radio-inline">
                    <input type="radio" name="tipo_busqueda" id="busqueda_por_estado" checked
                           onclick="Ticket.acciones.cambioLista('por_estacion');
                                    $('#por_estacion').removeClass('oculto');
                                    $('#por_codido').addClass('oculto');""> Estaci&oacute;n
                </label>

                <label class="radio-inline">
                    <input type="radio" name="tipo_busqueda" id="busqueda_por_codigo"
                           onclick="Ticket.acciones.cambioLista('por_codigo');
                                    $('#por_codido').removeClass('oculto');
                                    $('#por_estacion').addClass('oculto');"> C&oacute;digo
                </label>
            </li>
        </ol>
    </div>
</div>
<input type="hidden" value="lote" id="como_listo">

<div id="contenido_buscar">

        <!--Por codigo-->
        <div class="oculto" id="por_codido">

            <div class="row">
                <div class="form-inline">
                    <div class="col-xs-12">

                        <!--Identificador-->
                        <div class="form-group espacio" style="vertical-align: top">
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
        <div class="" id="por_estacion">

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


    <!--Espacio-->
    <div class="row">
        <div class="col-xs-12">&nbsp;</div>
    </div>
</div>
<div id="listado_ticket"></div>

<script>
    Ticket.acciones.cargarListaTicketPorEstacion();
</script>