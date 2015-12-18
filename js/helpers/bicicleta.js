var Bicicleta = {

    acciones: {

        cargarListaBicicletasPorCodigo: function () {
            var bicicleta_codigo = $('#codigo_bicicleta').val();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Bicicleta/cargarVistaListadoBicicletasPorCodigo/" + bicicleta_codigo,
                data: {}
            })
                .done(function (r) {
                    $('#listado_bicicletas').html(r);
                });
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
        }
    }
};