<?php
$Ticket = new Ticket();
if ($filtro == 'estacion') {
    $tickets = $Ticket->cargarTicketPorEstacionEstado($estacion_id, $estado_id, $fecha);
} elseif ($filtro == 'campo') {
    $tickets = $Ticket->cargarTicket($campo, $valor);
}
?>
<h3>
    Lista de Tickets
    <small class="pull-right"> Total: <?= count($tickets); ?></small>
</h3>

<div id="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Ticket ID</th>
                    <th class="oculto">Tipo</th>
                    <th>Usuario</th>
                    <th>Bicicleta</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha / Hora de Solicitud</th>
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
                        <?php
                            switch ($ticket->ESTADO_id) {
                                case 13:
                                    $color_estado = 'text-danger';
                                    break;

                                case 12:
                                    $color_estado = 'text-success';
                                    break;

                                case 11:
                                    $color_estado = 'text-primary';
                                    break;

                                case 10:
                                    $color_estado = 'text-warning';
                                    break;

                                default:
                                    $color_estado = '';
                                    break;
                            }
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <?php $i++ ?>
                            <?php $estacionamiento_origen = Estacionamiento::getEstacionamientoOrigenDestino($ticket->origen_estacionamiento) ?>
                            <?php $estacionamiento_destino = Estacionamiento::getEstacionamientoOrigenDestino($ticket->destino_estacionamiento) ?>
                            <td><strong><?= $ticket->id ?></strong></td>
                            <td class="oculto"><?= Tipo::getReservaTipoById($ticket->TIPO_id) ?></td>
                            <td><i class="fa fa-user"></i> <?= Usuario::getUsuarioNombreById($ticket->USUARIO_id) ?></td>
                            <td><i class="fa fa-bicycle"></i> <?= Bicicleta::getBicicletaCodigoById($ticket->BICICLETA_id) ?></td>
                            <td><i class="fa fa-home"></i> <?= Estacion::getEstacionNombreById($ticket->origen_puesto_alquiler) . ' - ' . $estacionamiento_origen ?></td>
                            <td><i class="fa fa-home"></i> <?= Estacion::getEstacionNombreById($ticket->destino_puesto_alquiler) . ' - ' . $estacionamiento_destino ?></td>
                            <td><?= $ticket->fecha.' / <small>'.$ticket->hora_creacion.'</small>' ?></td>
                            <td><?= $ticket->hora_retiro ?></td>
                            <td><?= $ticket->hora_entrega ?></td>
                            <td class="<?= $color_estado ?>"><?= Estado::getEstadoNombreById($ticket->ESTADO_id) ?></td>
                            <td>

                                <?php if ($ticket->ESTADO_id == 10) { ?>
                                    <button class="btn btn-xs btn-primary" type="button" title="Marcar En curso"
                                            data-toggle="modal" data-target="#marcarEstadoEnCurso_<?= $ticket->id ?>"
                                            id="en_curso_ticket_<?= $ticket->id ?>">
                                        &nbsp;&nbsp;&nbsp;<i class="fa fa-circle-o fa-2x"></i>&nbsp;&nbsp;&nbsp;
                                    </button>

                                    <!--Modal marcar En curso-->
                                    <?php $Ticket->load->view('reserva/en_curso', compact('ticket')); ?>
                                <?php } ?>

                                <?php if ($ticket->ESTADO_id == 11) { ?>
                                    <button class="btn btn-xs btn-success" type="button" title="Marcar Realizado"
                                            data-toggle="modal" data-target="#marcarEstadoRealizada_<?= $ticket->id ?>"
                                            id="realizado_ticket_<?= $ticket->id ?>">
                                        &nbsp;&nbsp;&nbsp;<i class="fa fa-check-circle-o fa-2x"></i>&nbsp;&nbsp;&nbsp;
                                    </button>

                                    <!--Modal marcar Realizada-->
                                    <?php $Ticket->load->view('reserva/realizada', compact('ticket')); ?>
                                <?php } ?>

                                <?php if ($ticket->ESTADO_id == 10) { ?>
                                    <button class="btn btn-xs btn-danger" type="button" title="Marcar Anulado"
                                            data-toggle="modal" data-target="#marcarEstadoAnulada_<?= $ticket->id ?>"
                                            id="anular_ticket_<?= $ticket->id ?>">
                                        &nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle-o fa-2x"></i>&nbsp;&nbsp;&nbsp;
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
            <div class="tip text-center espacioAbajoFijo">
                <small>
                    <a href="#listado_busqueda">Ir al inicio</a>
                </small>
            </div>
        </div>
    </div>
</div>