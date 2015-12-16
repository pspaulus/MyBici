var Estacion = {

    acciones: {

        guardar: function() {
            var id = $('#estacion_id');
            var nombre = $('#nombre');
            var input_coordenada_x = $('#coordenada_x');
            var input_coordenada_y = $('#coordenada_y');

            if (nombre.val() !='' && input_coordenada_x.val() !='' && input_coordenada_y.val() !='' ){
                //alert('guarda -> '+id.val());
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Estacion/crearEstacion",
                    data: {
                        nombre: nombre.val().trim(),
                        coordenada_x: input_coordenada_x.val(),
                        coordenada_y: input_coordenada_y.val()
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('Estacion guardado');
                            //$('.modal-backdrop').remove();
                        } else {
                            console.log('Error al guardar Estacion');
                        }
                    });
            }
        },

        limpiar: function() {
            var input_nombre = $('#nombre');
            var input_coordenada_x = $('#coordenada_x');
            var input_coordenada_y = $('#coordenada_y');

            input_nombre.val('');
            input_coordenada_x.val('');
            input_coordenada_y.val('');
        }
    }
};