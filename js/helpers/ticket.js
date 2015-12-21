var Ticket = {

    acciones: {
        refrescar: function () {
            $('#resultado').html(Escritorio.load.ticket());
        },

        guardar: function () {
            var input_id = $('#ticket_id');
            var select_tipo = $('#ticket_tipo');
            var input_fecha = $('#ticket_fecha');
            var select_estacion_origen = $('#estacion_origen');
            var select_estacion_destino = $('#estacion_destino');
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
        }

    },

    validaciones: {}
};
