var Estacion = {

    acciones: {

        guardar: function () {
            var mensaje = '';
            var input_codigo = $('#codigo');
            var input_nombre = $('#nombre');
            var input_longitud = $('#longitud');
            var input_latitud = $('#latitud');
            var input_numero_estaciones = $('#numero_estaciones');

            var validacion_codigo = true;
            var validacion_nombre = true;
            var validacion_longitud = true;
            var validacion_latitud = true;
            var validacion_estaciones = true;

            if (input_codigo.val() == '') {
                validacion_codigo = false;
                mensaje = $('#error_codigo_parqueos');
                Estacion.mensajes.mostrar(mensaje);
            }

            if (input_nombre.val() == '') {
                validacion_nombre = false;
                mensaje = $('#error_nombre_parqueos');
                Estacion.mensajes.mostrar(mensaje);
            }

            if (input_longitud.val() == '') {
                validacion_longitud = false;
                mensaje = $('#error_longitud_parqueos');
                Estacion.mensajes.mostrar(mensaje);
            }

            if (input_latitud.val() == '') {
                validacion_latitud = false;
                mensaje = $('#error_latitud_parqueos');
                Estacion.mensajes.mostrar(mensaje);
            }

            if (input_numero_estaciones.val() <= 0) {
                validacion_estaciones = false;
                mensaje = $('#error_cantidad_parqueos');
                Estacion.mensajes.mostrar(mensaje);
            }

            if (validacion_codigo && validacion_nombre && validacion_longitud && validacion_latitud && validacion_estaciones) {
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Estacion/crearEstacion",
                    data: {
                        nombre: input_nombre.val(),
                        codigo: input_codigo.val().toUpperCase(),
                        longitud: input_longitud.val(),
                        latitud: input_latitud.val()
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('Ok al guardar Estaciión');
                            $('#crearEstacion').removeClass('in')
                            $('.modal-backdrop').remove();
                            $('#resultado').html(Escritorio.load.estacion());
                            Estacion.mensajes.oculta($('#error_ya_existe'));
                        } else {
                            console.log('Error al guardar Estacion');

                            Estacion.mensajes.mostrar($('#error_ya_existe'));

                        }
                    });
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
            var input_nombre = $('#nombre');
            var input_codigo = $('#codigo');
            var input_longitud = $('#longitud');
            var input_latitud = $('#latitud');
            var input_numero_estaciones = $('#numero_estaciones');

            input_nombre.val('');
            input_codigo.val('');
            input_longitud.val('');
            input_latitud.val('');
            input_numero_estaciones.val('1');
            Estacion.mensajes.oculta($('#error_ya_existe'));
        }
    },

    label: {
        cantidad: function () {
            var mensaje = $('#error_cantidad_parqueos');
            Estacion.mensajes.oculta(mensaje);
        },

        codigo: function () {
            var mensaje = $('#error_codigo_parqueos');
            Estacion.mensajes.oculta(mensaje);
        },

        nombre: function () {
            var mensaje = $('#error_nombre_parqueos');
            Estacion.mensajes.oculta(mensaje);
        },

        longitud: function () {
            var mensaje = $('#error_longitud_parqueos');
            Estacion.mensajes.oculta(mensaje);
        },

        latitud: function () {
            var mensaje = $('#error_latitud_parqueos');
            Estacion.mensajes.oculta(mensaje);
        }
    },

    mensajes: {
        mostrar: function (mensaje) {
            mensaje.parent('.mensaje').removeClass(' oculto');
            mensaje.parents('.agrupador').addClass(' has-error');
        },

        oculta: function (mensaje) {
            mensaje.parent('.mensaje').addClass(' oculto');
            mensaje.parents('.agrupador').removeClass(' has-error');
        }
    }
};