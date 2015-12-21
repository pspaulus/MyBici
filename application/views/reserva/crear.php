<?php $Estacion = new Estacion(); ?>

<div class="modal fade" id="crearTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Crear Ticket</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="form_ticket">
                    <div class="row">

                        <!--id-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="ticket_id">Id</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-2">
                                    <input class="form-control" id="ticket_id" type="text"
                                           value="<?= Ticket::cargarUltimoId(); ?>" disabled>
                                </div>
                                <div class="col-xs-1 col-xs-offset-1">
                                    <label for="ticket_tipo">Tipo</label>
                                </div>
                                <div class="col-xs-3">
                                    <select class="form-control" id="ticket_tipo" disabled>
                                        <option value="3">Recorrido</option>
                                        <option value="4">Tiempo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--fecha-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="ticket_fecha">Fecha</label>
                            </div>

                            <div class="col-xs-3">
                                <input class="form-control" id="ticket_fecha" type="text"
                                       value="<?= date('Y-m-d') ?>" disabled>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-1">
                                    <label for="ticket_bicicleta">Bicicleta</label>
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" id="ticket_bicicleta" type="text"
                                           value="<?= Bicicleta::cargarBicicletaDisponibleMostrar(1) ?>" disabled>
                                </div>
                                <div class="col-xs-6 col-xs-offset-6 oculto mensaje">
                                    <label class="control-label" id="estacion_sin_bicicleta">&iexcl;Estaci&oacute;n sin
                                        bicicletas disponibles!</label>
                                </div>
                            </div>
                        </div>

                        <!--Usuario-->
                        <div class="form-group">

                            <div class="agrupador">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="ticket_usuario_nombre">Usuario</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" id="ticket_usuario_codigo" type="text" placeholder="Id"
                                           disabled>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group input-group">
                                        <input class="form-control" id="ticket_usuario_nombre" type="text"
                                               placeholder="nombre de usuario">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button"
                                                    onclick="Usuario.acciones.getUsuarioIdByNombre()"><i
                                                    class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                    <div class="oculto mensaje">
                                        <label class="control-label" id="usuario_no_existe">&iexcl;Usuario no existe o inactivo!</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $estaciones = $Estacion->cargarEstaciones() ?>
                        <!--Origen-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="estacion_origen">Origen</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-7">
                                    <select id="estacion_origen" class="form-control"
                                            onchange="Ticket.acciones.cargarBicicletaDisponible()">
                                        <?php foreach ($estaciones as $estacion) { ?>
                                            <option
                                                value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--Destino-->
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="estacion_destino">Destino</label>
                            </div>
                            <div class="agrupador">
                                <div class="col-xs-7">
                                    <select id="estacion_destino" class="form-control">
                                        <?php foreach ($estaciones as $estacion) { ?>
                                            <option
                                                value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--Mensajes de error-->
                        <div class="form-group">
                            <div class="agrupador">
                                <div class="col-xs-9 col-xs-offset-3 mensaje oculto">
                                    <label class="control-label" id="error_ya_existe">&iexcl;C&oacute;digo o nombre
                                        duplicado!</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Ticket.acciones.limpiar()">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="Ticket.acciones.guardar();">Guardar</button>
            </div>

        </div>
    </div>
</div>