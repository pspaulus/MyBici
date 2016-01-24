var Estacionamiento = {

    acciones: {

        guardar: function () {
            var estacion_id = $('#select_estacion').val();
            var cantidad_nuevo = $('#numero_estaciones_nuevo').val();

            var validacion_cantidad_nuevo = true;

            if (cantidad_nuevo <= 0) {
                validacion_cantidad_nuevo = false;
                Estacion.mensajes.mostrar($('#error_cantidad_nuevo'));
            } else {
                Estacion.mensajes.oculta($('#error_cantidad_nuevo'));
            }

            if (validacion_cantidad_nuevo) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Estacionamiento/crearEstacionamiento/" + estacion_id + '/' + cantidad_nuevo
                })
                    .done(function (r) {
                    });

                $('#crear_estacionamiento').removeClass('in');
                $('.modal-backdrop').remove();
                Escritorio.load.estacion();
            }
        },


        eliminar: function () {
            var estacion_id = $('#select_estacion').val();
            var cantidad_eliminar = $('#cantidad_eliminar').val();

            var validacion_cantidad_eliminar = true;

            if (validacion_cantidad_eliminar <= 0) {
                validacion_cantidad_eliminar = false;
                Estacion.mensajes.mostrar($('#error_cantidad_eliminar'));
            } else {
                Estacion.mensajes.oculta($('#error_cantidad_eliminar'));
            }

            if (validacion_cantidad_eliminar) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Estacionamiento/eliminarFisico/" + estacion_id + '/' + cantidad_eliminar
                })
                    .done(function (r) {
                        console.log(r.mensaje);
                        $('.modal-backdrop').remove();
                        if (r.status) {
                            Estacionamiento.acciones.limpiarEliminar();
                            Escritorio.mensajeFlotante.mostrar($('#eliminar_ok'));
                        } else {
                            Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                        }
                    });

                $('#crear_estacionamiento').removeClass('in');
                Escritorio.load.estacion();
            } else {
                console.log('ERROR: no eliminar por validaciones');
            }
        },

        cargarListaEstacionamientos: function () {
            var estacion_id = $('#select_estacion').val();
            var estacionamiento_estado = $('#filtro_estado_estacionamiento').val();

            if (estacion_id != null) {
                Estacion.mensajes.oculta($('#error_sin_estacion'));

                $.ajax({
                    method: "POST",
                    url: base_url + "Estacionamiento/cargarVistaListadoEstacionamientos/" + estacion_id + '/' + estacionamiento_estado,
                    beforeSend: function () {
                        $('#listado_estacionamientos').html(
                            '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                            '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                            '</div>');
                    }
                })
                    .done(function (r) {
                        $('#listado_estacionamientos').html(r);
                    });
            } else {
                console.log('ERROR: al cargar el listado de estacionaiento');
                Estacion.mensajes.mostrar($('#error_sin_estacion'));
            }
        },

        limpiar: function () {
            $('#numero_estaciones_nuevo').val('1');
            Estacion.mensajes.oculta($('#error_cantidad_nuevo'));
        },

        limpiarEliminar: function () {
            $('#cantidad_eliminar').val('1');
            Estacion.mensajes.oculta($('#error_cantidad_eliminar'));
        },

        limpiarAgregar: function (estacionamiento_id) {
            $('#bicicleta_codigo_' + estacionamiento_id).val('');
            Estacion.mensajes.oculta($('#error_bicicleta_codigo_' + estacionamiento_id));
            Estacion.mensajes.oculta($('#bicicleta_ya_estacionada_' + estacionamiento_id));
            Estacion.mensajes.oculta($('#bicicleta_en_uso_' + estacionamiento_id));
        },

        obtenerCodigoBicicleta: function (estacionamiento_id) {
            var busy = $('#busy_agregar');
            busy.html('<i class="fa fa-spinner fa-spin fa-1x"></i>');
            var bicicleta_codigo = $('#bicicleta_codigo_' + estacionamiento_id).val().toUpperCase();

            if (bicicleta_codigo.length >= 3) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Bicicleta/getIdBicicletaByCodigo/" + bicicleta_codigo
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('OK: obtuvo bicicleta_id ->' + r.bicicleta_id);

                            if ((r.bicicleta_estado == 9) || (r.bicicleta_estado == 6)) { //en_reserva o en_uso
                                Estacion.mensajes.mostrar($('#bicicleta_en_uso_' + estacionamiento_id));

                            } else {
                                //if ((r.bicicleta_estado == 8) && (r.bicicleta_estado == 3)) { //danada o reparar
                                //Estacion.mensajes.mostrar($('#bicicleta_danada_' + estacionamiento_id));

                                //} else{
                                Estacionamiento.acciones.verificarBicicletaEstacionada(estacionamiento_id, r.bicicleta_id);
                                //}
                            }
                        } else {
                            console.log('ERROR: no existe bicicleta');
                            Estacion.mensajes.mostrar($('#no_existe_bicicleta_codigo_' + estacionamiento_id));
                        }
                    });
            } else {
                Estacion.mensajes.mostrar($('#error_bicicleta_codigo_' + estacionamiento_id));
            }
            busy.html('');
        },

        verificarBicicletaEstacionada: function (estacionamiento_id, bicicleta_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/verificarBicicletaEstacionada/" + bicicleta_id
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: bicicleta no estacionada, entonce la estaciono ');
                        Estacionamiento.acciones.agregarBicicleta(estacionamiento_id, bicicleta_id);
                    } else {
                        $('#codigo_estacion').html(r.estacionamiento_codigo);
                        console.log('ERROR: bicicleta ya estacionada en ' + r.estacionamiento_codigo);
                        Estacion.mensajes.mostrar($('#bicicleta_ya_estacionada_' + estacionamiento_id))
                    }
                });
        },

        agregarBicicleta: function (estacionamiento_id, bicicleta_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Estacionamiento/agregarBicicleta/" + estacionamiento_id + '/' + bicicleta_id,
                beforeSend: function () {
                    $('#listado_estacionamientos').html(
                        '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    console.log(r.mensaje);
                    $('.modal-backdrop').remove();
                    $('#agregarBicicleta_' + estacionamiento_id).modal('toggle');
                    if (r.status) {
                        Escritorio.mensajeFlotante.mostrar($('#guardar_ok'));
                        Estacionamiento.acciones.cargarListaEstacionamientos();
                    } else {
                        Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                    }
                });
        },

        quitarBicicleta: function (estacionamiento_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Estacionamiento/quitarBicicleta/" + estacionamiento_id,
                beforeSend: function () {
                    $('#listado_estacionamientos').html(
                        '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    console.log(r.mensaje);
                    $('.modal-backdrop').remove();
                    $('#quitarBicicleta_' + estacionamiento_id).modal('toggle');
                    if (r.status) {
                        Escritorio.mensajeFlotante.mostrar($('#eliminar_ok'));
                        Estacionamiento.acciones.cargarListaEstacionamientos();
                    } else {
                        Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                    }
                });
        }
    },

    label: {
        cantidad: function () {
            var mensaje = $('#error_cantidad_parqueos');
            Estacion.mensajes.oculta(mensaje);
        }
    }

};
