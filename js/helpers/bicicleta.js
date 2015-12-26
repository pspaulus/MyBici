var Bicicleta = {

    acciones: {

        cargarListaBicicletasPorCodigo: function () {
            var bicicleta_codigo = $('#codigo_bicicleta');

            if (bicicleta_codigo.val().length > 2 ){
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Bicicleta/cargarVistaListadoBicicletasPorCodigo/" + bicicleta_codigo.val().toUpperCase(),
                    data: {}
                })
                    .done(function (r) {
                        $('#listado_bicicletas').html(r);
                    });
            } else {
                var mensaje = $('#error_formato_codigo');
                mensaje.parent('.mensaje').addClass(' has-error');
                mensaje.parent('.mensaje').removeClass(' oculto');
            }
        },

        cargarListaBicicletasPorEstacion: function () {
            var estacion_id = $('#select_estacion_inventario').val();
            var estado_id = $('#select_estado_inventario').val();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Bicicleta/cargarVistaListadoBicicletasPorEstacion/" + estacion_id + '/' + estado_id,
                data: {}
            })
                .done(function (r) {
                    $('#listado_bicicletas').html(r);
                });
        },

        marcarEstado: function (id, estado) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Bicicleta/marcarEstado/" + estado,
                data: {id: id}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('ok cambio estado bicicleta');
                        $('.modal-backdrop').remove();
                        Inventario.acciones.refrescar();
                    } else {
                        console.log('error cambio estado bicicleta');
                    }
                });
        },

        quitarEstacionamiento: function (ticket_id) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Bicicleta/quitarEstacionamiento/" + ticket_id,
                data: {}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: se quita la bicicleta del estacionamiento');
                    } else {
                        console.log('Error: no se quita la bicicleta del estacionamiento');
                    }
                });
        },

        cargarUltimoCodigoEstacion: function () {
            var estacion_id = $('#select_estacion_inventario_nuevo').val();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Estacion/getCodigoEstacionById/" + estacion_id,
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
                url: "http://mybici.server/Bicicleta/getSecuenciaCodigo/" + estacion_id,
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
        },

        guardar: function () {
            var input_cantidad_nuevo = $('#input_cantidad_nuevo');

            var input_codigo_estacion_nuevo = $('#input_codigo_estacion_nuevo');
            var input_codigo_bicicleta_nuevo = $('#input_codigo_bicicleta_nuevo');
            var select_estacion_inventario_nuevo = $('#select_estacion_inventario_nuevo');
            var select_tipo_nuevo = $('#select_tipo_nuevo');
            var select_estado_nuevo = $('#select_estado_nuevo');

            var secuencia = 0;

            if (input_cantidad_nuevo.val() > 0 && input_cantidad_nuevo.val() < 100) {

                for (var i = 0; i < input_cantidad_nuevo.val(); i++) {

                    secuencia = parseInt(input_codigo_bicicleta_nuevo.val()) + i;

                    console.log('codigo:'+ input_codigo_estacion_nuevo.val() + 'B' + secuencia +'\n'+
                        'PUESTO_ALQUILER_id:' + select_estacion_inventario_nuevo.val() +'\n'+
                        'TIPO_id:' + select_tipo_nuevo.val()+'\n'+
                        'ESTADO_id:' + select_estado_nuevo.val());
                    $.ajax({
                        method: "POST",
                        url: "http://mybici.server/Bicicleta/guardarBicicleta/",
                        data: {
                            codigo: input_codigo_estacion_nuevo.val() + 'B' + secuencia,
                            PUESTO_ALQUILER_id: select_estacion_inventario_nuevo.val(),
                            TIPO_id: select_tipo_nuevo.val(),
                            ESTADO_id: select_estado_nuevo.val()
                        }
                    })
                        .done(function (r) {
                            console.log('guardado blicicleta estado ->' + r.status);
                            $('.modal-backdrop').remove();
                            Inventario.acciones.refrescar();
                        });
                }
            } else {
                var mensaje = $('#error_cantidad');
                mensaje.parent('.mensaje').addClass(' has-error');
                mensaje.parent('.mensaje').removeClass(' oculto');
            }
        },

        validarCantidad: function () {
            var mensaje = $('#error_cantidad');
            mensaje.parent('.mensaje').removeClass(' has-error');
            mensaje.parent('.mensaje').addClass(' oculto');
        },

        validarFormatoCodigo: function () {
            var mensaje = $('#error_formato_codigo');
            mensaje.parent('.mensaje').removeClass(' has-error');
            mensaje.parent('.mensaje').addClass(' oculto');
        }

    }
};