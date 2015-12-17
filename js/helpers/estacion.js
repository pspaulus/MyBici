var Estacion = {

    acciones: {

        guardar: function () {
            var id = $('#estacion_id');
            var input_nombre = $('#nombre');
            var input_codigo = $('#codigo');
            var input_coordenada_x = $('#coordenada_x');
            var input_coordenada_y = $('#coordenada_y');

            if (input_nombre.val() != '' && input_coordenada_x.val() != '' && input_coordenada_y.val() != '') {
                //alert('guarda -> '+id.val());
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Estacion/crearEstacion",
                    data: {
                        nombre: input_nombre.val().trim(),
                        codigo: input_codigo.val().toUpperCase().trim(),
                        coordenada_x: input_coordenada_x.val(),
                        coordenada_y: input_coordenada_y.val()
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('Estacion guardado ');
                            //console.log('modal -> '+$('#crearEstacion'));
                            $('#crearEstacion').removeClass('in')
                            $('.modal-backdrop').remove();
                            $('#resultado').html(Escritorio.load.estacion());
                        } else {
                            console.log('Error al guardar Estacion');
                        }
                    });
            }
        },

        cargarListaParqueos: function () {
            var id = $('#select_estacion').val();
            var estado = $('#filtro_estado_parqueo').val();
            //alert('cargar lista parqueo ->' + id);
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
            var input_coordenada_x = $('#coordenada_x');
            var input_coordenada_y = $('#coordenada_y');

            input_nombre.val('');
            input_codigo.val('');
            input_coordenada_x.val('');
            input_coordenada_y.val('');
        }
    }
};