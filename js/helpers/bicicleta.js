var Bicicleta = {

    acciones: {

        pressEnterUnidad: function (e) {
            if (e.keyCode == 13) {
                console.log('Presiona enter unidad');
                Bicicleta.acciones.cargarListaBicicletasPorCodigo();
            }
        },

        pressEnterLote: function (e) {
            if (e.keyCode == 13) {
                console.log('Presiona enter lote');
                Bicicleta.acciones.cargarListaBicicletasPorEstacion();
            }
        },

        cambioLista: function(filtro){
            var como_listo = $('#como_listo');
            como_listo.val(filtro)

        },

        RecargarTotal: function(){
            var contenedor = $('#total_invetario');
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/mostrarTotalBicicletas/"
            })
                .done(function (r) {
                    contenedor.html(r);
                });
        },

        RecargarResumen: function() {
            var contenedor = $('#resumen_inventario');
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/RecargarResumen/",
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

        cargarListaBicicletasPorCodigo: function () {
            var bicicleta_codigo = $('#codigo_bicicleta');

            if (bicicleta_codigo.val() != '') {
                if (bicicleta_codigo.val().length > 2) {
                    $.ajax({
                        method: "POST",
                        url: base_url + "Bicicleta/cargarVistaListadoBicicletasPorCodigo/" + bicicleta_codigo.val().toUpperCase(),
                        beforeSend: function () {
                            $('#listado_bicicletas').html(
                                '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                                '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                                '</div>');
                        }
                    })
                        .done(function (r) {
                            $('#listado_bicicletas').html(r);
                        });
                } else {
                    Estacion.mensajes.mostrar($('#error_formato_codigo'));
                }
            } else {
                Estacion.mensajes.mostrar($('#error_vacio_codigo'));
            }
        },

        cargarListaBicicletasPorEstacion: function () {
            var estacion_id = $('#select_estacion_inventario').val();
            var estado_id = $('#select_estado_inventario').val();

            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/cargarVistaListadoBicicletasPorEstacion/" + estacion_id + '/' + estado_id,
                beforeSend: function () {
                    $('#listado_bicicletas').html(
                        '<div class="col-xs-12 text-center" style="margin-top: 25px">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    $('#listado_bicicletas').html(r);
                });
        },

        marcarEstado: function (bicicleta_id, estado_texto) {
            var como_listo =  $('#como_listo').val();
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/marcarEstado/" + estado_texto,
                data: {id: bicicleta_id}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: cambio estado bicicleta');
                        //$('.modal-backdrop').remove();
                        //Inventario.acciones.refrescar();
                        var modal ='';
                        if(estado_texto == 'danada'){
                            modal = $('#marcarEstadoDanada_'+bicicleta_id);
                        }
                        if(estado_texto == 'reparar'){
                            modal = $('#marcarEstadoReparar_'+bicicleta_id);
                        }
                        if(estado_texto == 'buena'){
                            modal = $('#marcarEstadoBuena_'+bicicleta_id);
                        }
                        modal.modal('toggle');
                        $('.modal-backdrop').remove();
                        Bicicleta.acciones.RecargarResumen();
                        if (como_listo == 'unidad'){
                            Bicicleta.acciones.cargarListaBicicletasPorCodigo();
                        }
                        if (como_listo == 'lote') {
                            Bicicleta.acciones.cargarListaBicicletasPorEstacion();
                        }
                        Escritorio.mensajeFlotante.mostrar($('#editar_ok'));
                    } else {
                        console.log('ERROR: cambio estado bicicleta');
                        Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                    }
                });
        },

        quitarEstacionamiento: function (ticket_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/quitarEstacionamiento/" + ticket_id,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: se quita la bicicleta del estacionamiento');
                    } else {
                        console.log('Error: no se quita la bicicleta del estacionamiento');
                        Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                    }
                });
        },

        cargarUltimoCodigoEstacion: function () {
            var estacion_id = $('#select_estacion_inventario_nuevo').val();

            $.ajax({
                method: "POST",
                url: base_url + "Estacion/getCodigoEstacionById/" + estacion_id,
                data: {}
            })
                .done(function (r) {
                    $('#input_codigo_estacion_nuevo').val(r);
                    Bicicleta.acciones.cargarUltimoCodigoBicicleta(estacion_id);
                });
        },

        cargarUltimoCodigoBicicleta: function (estacion_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/getSecuenciaCodigo/" + estacion_id,
                data: {}
            })
                .done(function (r) {
                    $('#input_codigo_bicicleta_nuevo').val(r);
                });
        },

        limpiar: function () {
            var input_cantidad_nuevo = $('#input_cantidad_nuevo');
            var select_estado_nuevo = $('#select_estado_nuevo');
            var select_tipo_nuevo = $('#select_tipo_nuevo');

            input_cantidad_nuevo.val('1');
            select_estado_nuevo.prop('selectedIndex', 1);
            select_tipo_nuevo.prop('selectedIndex', 0);

            var mensaje = $('#error_cantidad');
            mensaje.parent('.mensaje').removeClass(' has-error');
            mensaje.parent('.mensaje').addClass(' oculto');

            Estacion.mensajes.oculta($('#error_sin_estacion'));
        },

        guardar: function () {
            var input_cantidad_nuevo = $('#input_cantidad_nuevo');
            var parquear_bicicleta = $('#parquear_bicicleta');

            var input_codigo_estacion_nuevo = $('#input_codigo_estacion_nuevo');
            var input_codigo_bicicleta_nuevo = $('#input_codigo_bicicleta_nuevo');
            var select_estacion_inventario_nuevo = $('#select_estacion_inventario_nuevo');
            var select_tipo_nuevo = $('#select_tipo_nuevo');
            var select_estado_nuevo = $('#select_estado_nuevo');

            var secuencia = 0;

            if (select_estacion_inventario_nuevo.val() == null) {
                Estacion.mensajes.mostrar($('#error_sin_estacion'));

            } else {
                Estacion.mensajes.oculta($('#error_sin_estacion'));

                if (input_cantidad_nuevo.val() > 0 && input_cantidad_nuevo.val() < 100) {

                    for (var i = 0; i < input_cantidad_nuevo.val(); i++) {

                        secuencia = parseInt(input_codigo_bicicleta_nuevo.val()) + i;

                        console.log('codigo:' + input_codigo_estacion_nuevo.val() + 'B' + secuencia);
                        /*console.log('codigo:' + input_codigo_estacion_nuevo.val() + 'B' + secuencia + '\n' +
                         'PUESTO_ALQUILER_id:' + select_estacion_inventario_nuevo.val() + '\n' +
                         'TIPO_id:' + select_tipo_nuevo.val() + '\n' +
                         'ESTADO_id:' + select_estado_nuevo.val());*/
                        $.ajax({
                            method: "POST",
                            url: base_url + "Bicicleta/guardarBicicleta/",
                            data: {
                                codigo: input_codigo_estacion_nuevo.val() + 'B' + secuencia,
                                PUESTO_ALQUILER_id: select_estacion_inventario_nuevo.val(),
                                TIPO_id: select_tipo_nuevo.val(),
                                ESTADO_id: select_estado_nuevo.val()
                            }
                        })
                            .done(function (r) {
                                if (r.status) {
                                    console.log('OK: guardado blicicleta -> ' + r.bicicleta_id);

                                    if (parquear_bicicleta.is(":checked")) {
                                        Bicicleta.acciones.parquear(r.bicicleta_id);
                                    }
                                    $('.modal-backdrop').remove();
                                    //Inventario.acciones.refrescar();

                                    Bicicleta.acciones.limpiar();
                                    Bicicleta.acciones.cargarUltimoCodigoEstacion();
                                    $('#agregarBicicleta').modal('toggle');
                                    Bicicleta.acciones.RecargarResumen();
                                    Bicicleta.acciones.RecargarTotal();
                                    Escritorio.mensajeFlotante.mostrar($('#guardar_ok'));
                                } else {
                                    console.log('ERROR: No guarda blicicleta');
                                    Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                                }
                            });
                    }

                } else {
                    var mensaje = $('#error_cantidad');
                    mensaje.parent('.mensaje').addClass(' has-error');
                    mensaje.parent('.mensaje').removeClass(' oculto');
                }
            }
        },

        parquear: function (bicicleta_id) {
            $.ajax({
                method: "POST",
                url: base_url + "Bicicleta/Parquear/" + bicicleta_id,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: parquear ' + r.movimiento);
                    } else {
                        console.log('ERROR: parquear');
                    }
                });
        },

        validarCantidad: function () {
            var mensaje = $('#error_cantidad');
            mensaje.parent('.mensaje').removeClass(' has-error');
            mensaje.parent('.mensaje').addClass(' oculto');
        }
    }
};