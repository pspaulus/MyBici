var Ticket = {

    acciones: {
        refrescar: function () {
            $('#resultado').html(Escritorio.load.ticket());
        },

        guardar: function () {
            var input_id = $('#ticket_id').val();
            var select_tipo = $('#ticket_tipo').val();
            var input_bicicleta_codigo = $('#ticket_bicicleta').val();
            var input_fecha = $('#ticket_fecha').val();
            var input_usuario_id = $('#ticket_usuario_codigo').val();
            var select_estacion_origen = $('#estacion_origen').val();
            var select_estacion_destino = $('#estacion_destino').val();

            var validacion_input_bicicleta_codigo = true;
            var validacion_input_usuario_id = true;

            if (input_bicicleta_codigo == '' || input_bicicleta_codigo == '-') {
                validacion_input_bicicleta_codigo = false;
                console.log('Error: bicicleta_codigo');
            }

            if (input_usuario_id == 'Id' || input_usuario_id == '-') {
                validacion_input_usuario_id = false;
                console.log('Error: usuario_id');
            }

            if (validacion_input_usuario_id && validacion_input_bicicleta_codigo) {
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Ticket/guardarTicket",
                    data: {
                        id: input_id,
                        TIPO_id: select_tipo,
                        USUARIO_id: input_usuario_id,
                        BICICLETA_codigo: input_bicicleta_codigo,
                        origen_puesto_alquiler: select_estacion_origen,
                        destino_puesto_alquiler: select_estacion_destino,
                        fecha: input_fecha,
                        hora_retiro: null,
                        hora_entrega: null,
                        duracion: null,
                        ESTADO_id: 10
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('Ok: guardar ticket ->' + r.ticket_nuevo_id);

                            Ticket.acciones.marcarBicicletaEstadoEnUso(r.ticket_bicicleta_id,'en_uso');

                            $('#crearTicket').removeClass('in');
                            $('.modal-backdrop').remove();
                            Ticket.acciones.refrescar();
                        } else {
                            console.log('Error: no guarda ticket');
                        }
                    });
            }
        },

        marcarBicicletaEstadoEnUso: function (id, estado) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Bicicleta/marcarEstado/" + estado,
                data: {id: id}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: cambio estado bicicleta ->'+estado);
                    } else {
                        console.log('ERROR: cambio estado bicicleta');
                    }
                });
        },

        buscar: function(){
            var buscar_tipo = $('#ticket_buscar_tipo').val();
            var valor = $('#ticket_valor').val();

            if (valor.length != ''){
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Ticket/cargarTicket/" + valor,
                    data: {}
                })
                    .done(function (r) {
                        if (r.status) {
                            Estacion.mensajes.oculta($('#error_no_valor'));
                            console.log('OK: cambio estado bicicleta ->'+estado);
                        } else {
                            console.log('ERROR: cambio estado bicicleta');
                        }
                    });

            } else{
                Estacion.mensajes.mostrar($('#error_no_valor'));
            }
        },

        limpiar: function () {
            $('#estacion_origen').prop('selectedIndex', 0);
            $('#estacion_destino').prop('selectedIndex', 0);
            Estacion.mensajes.oculta($('#estacion_sin_bicicleta'));
            Estacion.mensajes.oculta($('#usuario_no_existe'));
        },

        cargarBicicletaDisponible: function () {
            var select_estacion_origen = $('#estacion_origen');

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Bicicleta/cargarBicicletaDisponible/" + select_estacion_origen.val(),
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        $('#ticket_bicicleta').val(r.codigo_bicicleta);
                        Estacion.mensajes.oculta($('#estacion_sin_bicicleta'));
                    } else {
                        $('#ticket_bicicleta').val('-');
                        Estacion.mensajes.mostrar($('#estacion_sin_bicicleta'));
                    }
                });
        },

        cargarListaTicketPorEstacion: function(){
            console.log('Carga listado por estacion');
        }

    }
};
