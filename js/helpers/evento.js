var Evento = {

    acciones: {

        guardar: function () {
            var evento_tipo = $('#evento_tipo').val();
            var evento_nombre = $('#evento_nombre').val();
            var evento_descripcion = $('#evento_descripcion').val();
            var evento_estado = $('#evento_estado').val();
            var evento_cantidad = $('#evento_cantidad').val();

            var validacion_evento_tipo = true;
            var validacion_evento_nombre = true;
            var validacion_evento_estado = true;
            var validacion_evento_cantidad = true;

            if (evento_cantidad <= 0) {
                validacion_evento_cantidad = false;
                Estacion.mensajes.mostrar($('#error_cantidad'));
            }

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

            if(validacion_evento_tipo && validacion_evento_nombre && validacion_evento_estado && validacion_evento_cantidad){
                $.ajax({
                    method: "POST",
                    url: base_url + "Evento/guardar/",
                    data: {
                        tipo: evento_tipo,
                        nombre: evento_nombre,
                        cantidad: evento_cantidad,
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
        },

        cargarDatosEvento: function () {
            var estacion_id = $('#select_estacion').val();

            if (estacion_id != null) {
                Estacion.mensajes.oculta($('#error_sin_estacion'));

                $.ajax({
                    method: "POST",
                    url: base_url + "Estacion/cargarDatosEstacion/" + estacion_id,
                    data: {}
                })
                    .done(function (r) {
                        $('#datos_estacion').html(r);
                    });

                Estacion.validaciones.botonEditar('mostrar');
                Estacion.validaciones.botonGuardar('ocultar');
            } else {
                Estacion.mensajes.mostrar($('#error_sin_estacion'));
            }
        }
    }
};