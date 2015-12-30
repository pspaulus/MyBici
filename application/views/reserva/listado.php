<?php
$Ticket = new Ticket();
if ($filtro == 'estacion') {
    $tickets = $Ticket->cargarTicketPorEstacionEstado($estacion_id, $estado_id, $fecha);
} elseif ($filtro == 'campo') {
    $tickets = $Ticket->cargarTicket($campo, $valor);
}
?>
<div id="listado_ticket">
    <h3>Lista de Tickets</h3>

    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Tipo</th>
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
                <?php if ($tickets != null) { ?>
                    <?php $i = 1 ?>
                    <?php if( count($tickets) == 0) $Ticket->load->view('sin_datos')?>
                    <?php foreach ($tickets as $ticket) { ?>
                        <tbody>
                        <tr>
                            <td><strong><?= $i ?></strong></td>
                            <?php $i++ ?>
                            <?php $estacionamiento_origen = Estacionamiento::getEstacionamientoOrigenDestino($ticket->origen_estacionamiento) ?>
                            <?php $estacionamiento_destino = Estacionamiento::getEstacionamientoOrigenDestino($ticket->destino_estacionamiento) ?>
                            <td><?= $ticket->id ?></td>
                            <td><?= Tipo::getReservaTipoById($ticket->TIPO_id) ?></td>
                            <td><i class="fa fa-user"></i> <?= Usuario::getUsuarioNombreById($ticket->USUARIO_id) ?></td>
                            <td><i class="fa fa-bicycle"></i> <?= Bicicleta::getBicicletaCodigoById($ticket->BICICLETA_id) ?></td>
                            <td><?= Estacion::getEstacionNombreById($ticket->origen_puesto_alquiler) . ' - ' . $estacionamiento_origen ?></td>
                            <td><?= Estacion::getEstacionNombreById($ticket->destino_puesto_alquiler) . ' - ' . $estacionamiento_destino ?></td>
                            <td><?= $ticket->fecha ?></td>
                            <td><?= $ticket->hora_retiro ?></td>
                            <td><?= $ticket->hora_entrega ?></td>
                            <td><?= Estado::getEstadoNombreById($ticket->ESTADO_id) ?></td>
                            <td>

                                <?php if ($ticket->ESTADO_id == 10) { ?>
                                    <button class="btn btn-xs btn-primary" type="button" title="Marcar En curso"
                                            data-toggle="modal" data-target="#marcarEstadoEnCurso_<?= $ticket->id ?>"
                                            id="en_curso_ticket_<?= $ticket->id ?>"><i class="fa fa-circle-o fa-2x"></i>
                                    </button>

                                    <!--Modal marcar En curso-->
                                    <?php $Ticket->load->view('reserva/en_curso', compact('ticket')); ?>
                                <?php } ?>

                                <?php if ($ticket->ESTADO_id == 11) { ?>
                                    <button class="btn btn-xs btn-success" type="button" title="Marcar Realizada"
                                            data-toggle="modal" data-target="#marcarEstadoRealizada_<?= $ticket->id ?>"
                                            id="realizado_ticket_<?= $ticket->id ?>"><i
                                            class="fa fa-check-circle-o fa-2x"></i>
                                    </button>

                                    <!--Modal marcar Realizada-->
                                    <?php $Ticket->load->view('reserva/realizada', compact('ticket')); ?>
                                <?php } ?>

                                <?php if ($ticket->ESTADO_id == 10) { ?>
                                    <button class="btn btn-xs btn-danger" type="button" title="Marcar Anulada"
                                            data-toggle="modal" data-target="#marcarEstadoAnulada_<?= $ticket->id ?>"
                                            id="anular_ticket_<?= $ticket->id ?>"><i
                                            class="fa fa-times-circle-o fa-2x"></i>
                                    </button>

                                    <!--Modal marcar Anulada-->
                                    <?php $Ticket->load->view('reserva/anulada', compact('ticket')); ?>
                                <?php } ?>
                            </td>
                        </tr>
                        </tbody>
                    <?php } ?>
                <?php } ?>
            </table>
            <div class="tip text-center">
                <small>
                    <a href="#listado_busqueda">Ir al inicio</a>
                </small>
            </div>
        </div>
    </div>
</div>