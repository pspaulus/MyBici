var Estacionamiento = {

    acciones: {

        guardar: function () {
            var estacion_id = $('#select_estacion').val();
            var input_numero_estaciones_nuevo = $('#numero_estaciones_nuevo');

            var validacion_numero_estaciones_nuevo = true;

            if (input_numero_estaciones_nuevo.val() <= 0) {
                validacion_numero_estaciones_nuevo = false;
                Estacion.mensajes.mostrar($('#error_cantidad_parqueos'));
            } else {
                Estacion.mensajes.oculta($('#error_cantidad_parqueos'));
            }

            if (validacion_numero_estaciones_nuevo) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Estacionamiento/crearEstacionamiento/" + estacion_id + '/' + input_numero_estaciones_nuevo.val(),
                    data: {}
                })
                    .done(function (r) {
                    });

                $('#crear_estacionamiento').removeClass('in');
                $('.modal-backdrop').remove();
                Escritorio.load.estacion();
            }
        },

        cargarListaParqueos: function () {
            var estacion_id = $('#select_estacion').val();
            var estacionamiento_estado = $('#filtro_estado_parqueo').val();

            if (estacion_id != null) {
                Estacion.mensajes.oculta($('#error_sin_estacion'));

                $.ajax({
                    method: "POST",
                    url: base_url + "Estacionamiento/cargarVistaParqueos/" + estacion_id + '/' + estacionamiento_estado,
                    data: {},
                    beforeSend: function () {
                        $('#parqueos').html(
                            '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                                '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                            '</div>');
                    }
                })
                    .done(function (r) {
                        $('#parqueos').html(r);
                    });
            } else {
                Estacion.mensajes.mostrar($('#error_sin_estacion'));
            }
        },

        limpiar: function () {
            $('#numero_estaciones_nuevo').val('1');
            Estacion.mensajes.oculta($('#error_cantidad_parqueos'));
        },

        limpiarAgregar: function (estacionamiento_id) {
            $('#bicicleta_codigo_' + estacionamiento_id).val('');
            Estacion.mensajes.oculta($('#error_bicicleta_codigo_' + estacionamiento_id));
            Estacion.mensajes.oculta($('#bicicleta_ya_estacionada_' + estacionamiento_id));
            Estacion.mensajes.oculta($('#bicicleta_en_uso_' + estacionamiento_id));
        },

        obtenerCodigoBicicleta: function (estacionamiento_id) {
            var bicicleta_codigo = $('#bicicleta_codigo_' + estacionamiento_id).val().toUpperCase();

            if (bicicleta_codigo.length >= 3) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Bicicleta/getIdBicicletaByCodigo/" + bicicleta_codigo,
                    data: {}
                })
                    .done(function (r) {
                        console.log('bicicleta_estado -> ' + r.bicicleta_estado);
                        if ((r.bicicleta_estado != 9) && (r.bicicleta_estado != 6)) {
                            if (r.status) {
                                console.log('OK: obtener id bicicleta ->' + r.bicicleta_id);
                                Estacionamiento.acciones.verificarBicicletaEstacionada(estacionamiento_id, r.bicicleta_id);
                            } else {
                                console.log('ERROR: obtener id bicicleta');
                                Estacion.mensajes.mostrar($('#error_bicicleta_codigo_' + estacionamiento_id));
                            }
                        } else {
                            Estacion.mensajes.mostrar($('#bicicleta_en_uso_' + estacionamiento_id));
                        }
                    });
            } else {
                Estacion.mensajes.mostrar($('#error_bicicleta_codigo_' + estacionamiento_id));
            }

        },

        verificarBicicletaEstacionada: function (estacionamiento_id, bicicleta_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/verificarBicicletaEstacionada/" + bicicleta_id,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: bicicleta no estacionada, entonce la estaciono ');
                        Estacionamiento.acciones.agregarBicicleta(estacionamiento_id, bicicleta_id);
                    } else {
                        console.log('ERROR: bicicleta ya estacionada en ' + r.estacionamiento_id);
                        Estacion.mensajes.mostrar($('#bicicleta_ya_estacionada_' + estacionamiento_id))
                    }
                });
        },

        agregarBicicleta: function (estacionamiento_id, bicicleta_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Estacionamiento/agregarBicicleta/" + estacionamiento_id + '/' + bicicleta_id,
                data: {}
            })
                .done(function (r) {
                    $('#agregarBicicleta_' + estacionamiento_id).removeClass('in');
                    $('.modal-backdrop').remove();
                    Estacionamiento.acciones.cargarListaParqueos();
                });
        },

        quitarBicicleta: function (estacionamiento_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Estacionamiento/quitarBicicleta/" + estacionamiento_id,
                data: {}
            })
                .done(function (r) {
                    $('.modal-backdrop').remove();
                    Estacionamiento.acciones.cargarListaParqueos();
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
