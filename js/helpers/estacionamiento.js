var Estacionamiento = {

    acciones: {

        guardar: function () {
            var estacion_id = $('#select_estacion').val();
            var input_numero_estaciones_nuevo = $('#numero_estaciones_nuevo');

            var validacion_numero_estaciones_nuevo = true;

            if (input_numero_estaciones_nuevo.val() <= 0) {
                validacion_numero_estaciones_nuevo = false;
                Estacion.mensajes.mostrar($('#error_cantidad_parqueos'));
            }

            if (validacion_numero_estaciones_nuevo) {
                //for (var i = 0; i < input_numero_estaciones_nuevo.val(); i++) {
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Estacionamiento/crearEstacionamiento/" + estacion_id + '/' + input_numero_estaciones_nuevo.val(),
                    data: {}
                })
                    .done(function (r) {
                        //if (r.status) {
                        //    //console.log('Ok al guardar estacionamiento ' + r.estacionamiento_nuevo_id);
                        //    console.log('Ok al guardar estacionamiento');
                        //} else {
                        //    console.log('Error al guardar estacionamiento');
                        //}
                    });

                $('#crear_estacionamiento').removeClass('in');
                $('.modal-backdrop').remove();
                //Estacion.acciones.cargarDatosEstacion();
                Escritorio.load.estacion();
                //}
            }
        },

        cargarListaParqueos: function () {
            var id = $('#select_estacion').val();
            var estado = $('#filtro_estado_parqueo').val();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Estacionamiento/cargarVistaParqueos/" + id + '/' + estado,
                data: {}
            })
                .done(function (r) {
                    $('#parqueos').html(r);
                });
        },

        limpiar: function () {
            $('#numero_estaciones_nuevo').val('1');
        },

        limpiarAgregar: function (estacionamiento_id) {
            $('#bicicleta_codigo_' + estacionamiento_id).val('');
            Estacion.mensajes.oculta($('#error_bicicleta_codigo_' + estacionamiento_id));
            Estacion.mensajes.oculta($('#bicicleta_ya_estacionada_' + estacionamiento_id));
        },

        obtenerCodigoBicicleta: function (estacionamiento_id) {
            var bicicleta_codigo = $('#bicicleta_codigo_' + estacionamiento_id).val().toUpperCase();

            if (bicicleta_codigo.length >= 3) {
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Bicicleta/getIdBicicletaByCodigo/" + bicicleta_codigo,
                    data: {}
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('OK: obtener id bicicleta ->'+r.bicicleta_id);
                            Estacionamiento.acciones.verificarBicicletaEstacionada(estacionamiento_id, r.bicicleta_id);
                            //Estacionamiento.acciones.agregarBicicleta(estacionamiento_id, r.bicicleta_id);
                        } else {
                            console.log('ERROR: obtener id bicicleta');
                            Estacion.mensajes.mostrar($('#error_bicicleta_codigo_' + estacionamiento_id));
                        }
                    });
            } else {
                Estacion.mensajes.mostrar($('#error_bicicleta_codigo_' + estacionamiento_id));
            }

        },

        verificarBicicletaEstacionada: function (estacionamiento_id, bicicleta_id) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Bicicleta/verificarBicicletaEstacionada/" + bicicleta_id,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: bicicleta no estacionada, entonce la estaciono ');
                        Estacionamiento.acciones.agregarBicicleta(estacionamiento_id, bicicleta_id);
                    } else {
                        console.log('ERROR: bicicleta ya estacionada en '+ r.estacionamiento_id);
                        Estacion.mensajes.mostrar($('#bicicleta_ya_estacionada_' + estacionamiento_id))
                    }
                });
        },


        agregarBicicleta: function (estacionamiento_id, bicicleta_id) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Estacionamiento/agregarBicicleta/" + estacionamiento_id + '/' + bicicleta_id,
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
                url: "http://mybici.server/Estacionamiento/quitarBicicleta/" + estacionamiento_id,
                data: {}
            })
                .done(function (r) {
                    //$('#parqueos').html(r);
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
