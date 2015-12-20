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
                for (var i = 0; i < input_numero_estaciones_nuevo.val(); i++) {
                    $.ajax({
                        method: "POST",
                        url: "http://mybici.server/Estacionamiento/crearEstacionamiento/" + estacion_id,
                        data: {}
                    })
                        .done(function (r) {
                            if (r.status) {
                                console.log('Ok al guardar estacionamiento ' + r.estacionamiento_nuevo_id);
                            } else {
                                console.log('Error al guardar Estacion');
                            }
                        });

                    $('#crear_estacionamiento').removeClass('in');
                    $('.modal-backdrop').remove();
                    Estacion.acciones.cargarDatosEstacion();
                }
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
        }
    },

    label: {
        cantidad: function () {
            var mensaje = $('#error_cantidad_parqueos');
            Estacion.mensajes.oculta(mensaje);
        }
    },

    validaciones: {}

};
