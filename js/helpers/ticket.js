var Ticket = {

    index: {
        cargarVistaCrear: function(){
            var tdu = $('#tdu').val();
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/cargarVistaCrear/",
                data: {
                    tdu: tdu
                }
            })
                .done(function (r) {
                    $('#contenedor_div_crear').html(r);
                })
        },

        cargarBotonCrear: function() {
            var tdu = $('#tdu').val();
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/cargarBotonCrear/",
                data: {
                    tdu: tdu
                }
            })
                .done(function (r) {
                    $('#contendor_boton_crear').html(r);
                })
        }
    },

    acciones: {

        barrerTicket: function () {
            var barrer_ticket_contenedor = $('#barrer_ticket_contenedor');
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/barrerTicket"
            })
                .done(function (r) {
                    barrer_ticket_contenedor.html(r.mensaje);
                    Escritorio.mensajeFlotante.mostrar($('#barrer_ticket_contenedor'));
                });
        },

        cambioLista: function (filtro) {
            var como_listo = $('#como_listo');
            como_listo.val(filtro)
        },

        mostrarFiltroEstacion: function() {
            $.ajax({
                method: "POST",
                url: base_url + "Estacion/selectEstacion/"
            })
                .done(function (r) {
                    if (r.status) {
                        $('#select_estacion').html(r.html);
                    } else {
                        console.log('ERROR: al mostrar filtro de estacion');
                        Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                    }
                });
        },

        RecargarTotal: function(){
            var contenedor = $('#total_ticket');
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/mostrarConteTicketHoy/"
            })
                .done(function (r) {
                    contenedor.html(r);
                });
        },

        RecargarResumen: function() {
            var contenedor = $('#contenedor_resumen');
            var estacion_id = $('#select_estacion_resumen').val();
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/RecargarResumen/",
                data: {
                    estacion_id: estacion_id
                },
                beforeSend: function () {
                    contenedor.html(
                        '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    contenedor.html(r);
                });
        },

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
            var estacion_destino_parqueo_disponible = $('#estacion_destino_parqueo_disponible').val();

            var validacion_input_bicicleta_codigo = true;
            var validacion_input_usuario_id = true;
            var validacion_origen_destino = true;
            var validacion_usuario_sin_ticket = true;

            if (select_estacion_origen == select_estacion_destino) {
                validacion_origen_destino = false;
                console.log('Error: el origen es el mismo del destino');
            }

            if (input_bicicleta_codigo == '' || input_bicicleta_codigo == '-') {
                validacion_input_bicicleta_codigo = false;
                console.log('Error: bicicleta_codigo');
            }

            if (input_usuario_id == 'Id' || input_usuario_id == '-' || input_usuario_id == '') {
                validacion_input_usuario_id = false;
                Estacion.mensajes.mostrar($('#usuario_no_existe'));
                console.log('Error: usuario_id');
            }

            if (Ticket.acciones.usuarioSinTicket(input_usuario_id)) {
                validacion_usuario_sin_ticket = false;
                Estacion.mensajes.mostrar($('#error_usuario_con_ticket'));
            }

            if (validacion_input_usuario_id && validacion_input_bicicleta_codigo && validacion_origen_destino &&
                validacion_usuario_sin_ticket && (estacion_destino_parqueo_disponible == 1)) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Ticket/guardarTicket",
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

                            Ticket.acciones.marcarBicicletaEstadoEnUso(r.ticket_bicicleta_id, 'en_reserva');

                            //$('#crearTicket').removeClass('in');
                            $('.modal-backdrop').remove();
                            $('#crearTicket').modal('toggle');
                            Ticket.acciones.RecargarResumen();
                            //Ticket.acciones.refrescar();
                            Ticket.acciones.cargarBicicletaDisponible();
                            Ticket.acciones.RecargarTotal();
                            Ticket.acciones.limpiar();
                            Escritorio.mensajeFlotante.mostrar($('#guardar_ok'));
                        } else {
                            console.log('Error: no guarda ticket');
                            Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                        }
                    });
            }
        },

        usuarioSinTicket: function(id){
            if (id != 'Id' && id != '-' && id == ''){
                $.ajax({
                    method: "POST",
                    url: base_url + "Usuario/usuarioSinTicket/",
                    data: {id: id}
                })
                    .done(function (r) {
                        //console.log(r.mensaje);
                        return r.status;
                    });
            }
        },

        marcarBicicletaEstadoEnUso: function (id, estado) {
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/marcarEstado/" + estado,
                data: {id: id}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: cambio estado bicicleta -> ' + estado);
                    } else {
                        console.log('ERROR: cambio estado bicicleta');
                    }
                });
        },

        cambiarEstado: function (ticket_id, estado) {
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/cambiarEstado/" + ticket_id + '/' + estado,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: cambio estado ticket -> ' + r.ticket_id);

                        if (estado == 'en_curso') {
                            Ticket.acciones.marcarHora(ticket_id, 'retiro');
                            Ticket.acciones.cambiarEstadoBicicleta(ticket_id, 'en_uso');
                            Bicicleta.acciones.quitarEstacionamiento(ticket_id);
                        }
                        if (estado == 'realizada') {
                            Ticket.acciones.marcarHora(ticket_id, 'entrega');
                            Ticket.acciones.cambiarEstadoBicicleta(ticket_id, 'buena');
                            Ticket.acciones.registrarNuevoParqueo(ticket_id);
                        }
                        if (estado == 'anulada') {
                            Ticket.acciones.cambiarEstadoBicicleta(ticket_id, 'buena');
                        }

                        $('.modal-backdrop').remove();
                        Ticket.acciones.refrescar();
                    } else {
                        console.log('ERROR: cambio estado ticket');
                    }
                });
        },

        cambiarEstadoBicicleta: function (ticket_id, estado_texto) {
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/cambiarEstadoBicicleta/" + ticket_id + '/' + estado_texto,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: cambio estado bicicleta ->' + r.bicicleta_id);
                    } else {
                        console.log('ERROR: cambio estado bicicleta');
                    }
                });
        },

        marcarHora: function (ticket_id, tipo_hora) {
            $.ajax({
                method: "POST",
                url: base_url + "Ticket/marcarHora/" + ticket_id + '/' + tipo_hora,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: registro hora retiro');
                    } else {
                        console.log('ERROR: registro hora retiro');
                    }
                });
        },

        registrarNuevoParqueo: function (ticket_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/registrarNuevoParqueo/" + ticket_id,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: registro bicicleta en nuevo parqueo ' + r.movimiento);
                    } else {
                        console.log('ERROR: registro bicicleta en nuevo parqueo');
                    }
                });
        },

        cargarListaTicketPorEstacion: function () {
            var estacion_id = $('#select_ticket_estacion').val();
            var estado_id = $('#select_estado_ticket').val();
            var fecha = $('#filtro_fecha').val();

            $.ajax({
                method: "POST",
                url: base_url + "Ticket/cargarListaTicketPorEstacion/" + estacion_id + '/' + estado_id + '/' + fecha,
                beforeSend: function () {
                    $('#listado_ticket').html(
                        '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    $('#listado_ticket').html(r);
                });

        },

        cargarListaTicketPorCampo: function () {
            var campo = $('#ticket_campo').val();
            var valor = $('#ticket_valor').val();

            if (valor.length != '') {
                $.ajax({
                    method: "POST",
                    url: base_url + "Ticket/cargarListaTicketPorCampo/" + campo + '/' + valor,
                    beforeSend: function () {
                        $('#listado_ticket').html(
                            '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                            '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                            '</div>');
                    }
                })
                    .done(function (r) {
                        $('#listado_ticket').html(r);
                    });
            } else {
                Estacion.mensajes.mostrar($('#error_no_valor'));
            }
        },

        cargarListaTicketPorUsuario: function () {
            var campo = $('#ticket_campo').val();
            var valor = $('#ticket_valor').val();

            if (valor.length != '') {
                $.ajax({
                    method: "POST",
                    url: base_url + "Ticket/cargarListaTicketPorCampo/" + campo + '/' + valor,
                    data: {}
                })
                    .done(function (r) {
                        $('#listado_ticket').html(r);
                    });
            } else {
                Estacion.mensajes.mostrar($('#error_no_valor'));
            }
        },

        limpiar: function () {
            $('#estacion_origen').prop('selectedIndex', 0);
            $('#estacion_destino').prop('selectedIndex', 1);
            Estacion.mensajes.oculta($('#estacion_sin_bicicleta'));
            Estacion.mensajes.oculta($('#usuario_no_existe'));
            Estacion.mensajes.oculta($('#error_origen_destino'));
            Estacion.mensajes.oculta($('#error_sin_parqueo'));
            Ticket.index.cargarVistaCrear();
        },

        cargarBicicletaDisponible: function () {
            var select_estacion_origen = $('#estacion_origen');

            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/cargarBicicletaDisponible/" + select_estacion_origen.val(),
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

        validarEstacionamientoDisponible: function () {
            var estacion_destino_id = $('#estacion_destino').val();
            var estacion_destino_parqueo_disponible = $('#estacion_destino_parqueo_disponible');

            $.ajax({
                method: "POST",
                url: base_url + "Estacionamiento/validarEstacionamientoDisponible/" + estacion_destino_id,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        estacion_destino_parqueo_disponible.val(1);
                        console.log('OK: estacionamiento libre -> ' + r.estacionamiento_id);
                        Estacion.mensajes.oculta($('#error_sin_parqueo'));
                    } else {
                        estacion_destino_parqueo_disponible.val(0);
                        console.log('Error: No hay estacionamiento libre');
                        Estacion.mensajes.mostrar($('#error_sin_parqueo'));
                    }
                });
        },

        validarOrigenDestino: function () {
            var select_estacion_origen = $('#estacion_origen').val();
            var select_estacion_destino = $('#estacion_destino').val();

            if (select_estacion_origen == select_estacion_destino) {
                Estacion.mensajes.mostrar($('#error_origen_destino'));
            } else {
                Estacion.mensajes.oculta($('#error_origen_destino'));
            }
        },

        quitarDestinoRepetido: function () {
            var select_estacion_origen = $('#estacion_origen');
            //var select_estacion_destino = $('#estacion_destino');
            var valor = select_estacion_origen.val();

            $("#estacion_destino option[value=" + valor + "]").remove();
        },

        agregarDestinoRepetido: function () {
            var select_estacion_origen = $('#estacion_origen');
            //var select_estacion_destino = $('#estacion_destino');
            var valor = select_estacion_origen.val();
            var texto = $("#estacion_origen option:selected").text();

            $("#estacion_destino").append('<option value="' + valor + '">' + texto + '</option>');
            //Ticket.acciones.quitarDestinoRepetido();
        },

        cambiarValorPlaceholder: function () {
            var select_tipo = $('#ticket_campo');
            var ticket_valor_buscar = $('#ticket_valor');
            var valor;

            switch (select_tipo.val()) {
                case 'id':
                    valor = 'Ingrese ID';
                    break;

                case 'bicicleta':
                    valor = 'Ingrese c\u00F3digo ';
                    break;

                case 'usuario':
                    valor = 'Ingrese nombre';
                    break;
            }

            ticket_valor_buscar.attr('placeholder', valor);
        },

        pressEnter: function (e) {
            if (e.keyCode == 13) {
                console.log('Presiona enter');
                Ticket.acciones.cargarListaTicketPorCampo();
            }
        }
    }
};
