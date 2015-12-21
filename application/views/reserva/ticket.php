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
            <div class="row">

                <div class="col-xs-4">
                    <select class="form-control">
                        <option>ID</option>
                        <option>Usuario</option>
                        <option>C&oacute;digo Bicicleta</option>
                    </select>
                </div>

                <div class="col-xs-4">
                    <div class="form-group input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn"><button class="btn btn-default" type="button"><i
                                    class="fa fa-search"></i></button></span>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
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
                            <tbody>
                            <tr
                            ">
                            <td>001</td>
                            <td>lorem ipsum</td>
                            <td>Retiro</td>
                            <td>Llegada</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i>
                                </button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>