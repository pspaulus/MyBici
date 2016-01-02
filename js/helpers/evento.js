var Evento = {

    acciones: {

        guardar: function () {
            var evento_tipo = $('#evento_tipo').val();
            var evento_nombre = $('#evento_nombre').val();
            var evento_descripcion = $('#evento_descripcion').val();
            var evento_estado = $('#evento_estado').val();

            var validacion_evento_tipo = true;
            var validacion_evento_nombre = true;
            var validacion_evento_estado = true;

            if (evento_tipo == null) {
                validacion_evento_tipo = false;
                Estacion.mensajes.mostrar($('#tipo_vacio'));
            }

            if (evento_nombre.length == 0) {
                validacion_evento_nombre = false;
                Estacion.mensajes.mostrar($('#nombre_vacio'));
            }

            if (evento_estado == null) {
                validacion_evento_estado = false;
                Estacion.mensajes.mostrar($('#estado_vacio'));
            }

            if(validacion_evento_tipo && validacion_evento_nombre && validacion_evento_estado){
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Evento/guardar/",
                    data: {
                        tipo: evento_tipo,
                        nombre: evento_nombre,
                        descripcion: evento_descripcion
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('OK: guarda evento -> '+ r.evento_nuevo_id);
                        } else {
                            console.log('ERROR: no guarda evento');
                        }
                    });
            } else {
                console.log('ERROR: no guarda evento');
            }
        },

        limpiar: function() {
            $('#evento_nombre').val('');
            $('#evento_descripcion').val('');
            $('#evento_tipo').prop('selectedIndex', 0);
            $('#evento_estado').prop('selectedIndex', 0);
            Estacion.mensajes.oculta($('#nombre_vacio'));
        }
    }
};