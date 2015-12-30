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
                        <!-- validacion parqueos disponibles en estacion destino -->
                        <input type="hidden" id="estacion_destino_parqueo_disponible" value="1">


                        <div class="form-group">
                            <!--id-->
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="ticket_id">Id</label>
                            </div>
                            <div class="col-xs-3">
                                <input class="form-control" id="ticket_id" type="text"
                                       value="<?= Ticket::cargarUltimoId(); ?>" disabled>
                            </div>

                            <!--fecha-->
                            <div class="col-xs-2 ">
                                <label for="ticket_fecha">Fecha</label>
                            </div>
                            <div class="col-xs-3">
                                <input class="form-control" id="ticket_fecha" type="text"
                                       value="<?= Escritorio::getFechaEcuador() ?>" disabled>
                            </div>
                        </div>


                        <div class="form-group">
                            <!--Tipo-->
                            <div class="col-xs-2 col-xs-offset-1">
                                <label for="ticket_tipo">Tipo</label>
                            </div>
                            <div class="col-xs-3">
                                <select class="form-control" id="ticket_tipo" disabled>
                                    <option value="3">Recorrido</option>
                                    <option value="4">Tiempo</option>
                                </select>
                            </div>

                            <!--bicleta-->
                            <div class="agrupador">
                                <div class="col-xs-2">
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
                            <script>
                                Ticket.acciones.cargarBicicletaDisponible();
                            </script>
                        </div>


                        <div class="form-group">
                            <div class="agrupador">
                                <!--Usuario-->
                                <div class="col-xs-2 col-xs-offset-1">
                                    <label for="ticket_usuario_nombre">Usuario</label>
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" id="ticket_usuario_codigo" type="text" placeholder="Id"
                                           disabled>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group input-group">
                                        <input class="form-control" id="ticket_usuario_nombre" type="text"
                                               placeholder="Ingrese el nombre del usuario"
                                               onkeyup="Estacion.mensajes.oculta($('#usuario_no_existe'));">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button"
                                                    onclick="Usuario.acciones.getUsuarioIdByNombre()"><i
                                                    class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                    <div class="oculto mensaje">
                                        <label class="control-label" id="usuario_no_existe">&iexcl;Usuario no existe o
                                            inactivo!</label>
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
                                <div class="col-xs-8">
                                    <select id="estacion_origen" class="form-control"
                                            onchange="Ticket.acciones.cargarBicicletaDisponible();
                                                      Ticket.acciones.validarOrigenDestino();">
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
                                <div class="col-xs-8">
                                    <select id="estacion_destino" class="form-control"
                                            onchange="Ticket.acciones.validarEstacionamientoDisponible();
                                                      Ticket.acciones.validarOrigenDestino();">
                                        <?php foreach ($estaciones as $estacion) { ?>
                                            <option
                                                value="<?= $estacion->id ?>"><?= $estacion->codigo . ' - ' . $estacion->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xs-9 col-xs-offset-3">
                                    <div class="oculto mensaje">
                                        <label class="control-label" id="error_origen_destino">&iexcl;El detino no puede
                                            ser el mismo que el origen!</label>
                                    </div>
                                    <div class="oculto mensaje">
                                        <label class="control-label" id="error_sin_parqueo">&iexcl;El detino no tiene
                                            parqueos disponibes!</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            //Ticket.acciones.quitarDestinoRepetido();
                            $('#estacion_destino').prop('selectedIndex', 1);
                            Ticket.acciones.validarEstacionamientoDisponible();
                        </script>

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