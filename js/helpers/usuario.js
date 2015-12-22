var Usuario = {

    acciones: {
        guardar: function () {
            var nombre = $('#nombre');
            var contrasena = $('#contrasena');
            var confirmar_contrasena = $('#confirmar_contrasena');
            var tipo = $('#tipo_usuario');

            this.validoVacioUsuario(nombre);
            this.validoVacioUsuario(contrasena);
            this.validoVacioUsuario(confirmar_contrasena);

            if (nombre.val().length >= 4 && contrasena.val().length >= 8 && this.validarContrasena(contrasena, confirmar_contrasena, -1)) {
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Usuario/ingresarUsuario",
                    data: {
                        nombre: nombre.val().toLowerCase().trim(),
                        contrasena: $.md5(contrasena.val().trim()),
                        tipo: tipo.val()
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('usuario guardado');
                            $('#resultado').html(Escritorio.load.usuario());
                            $('.modal-backdrop').remove();
                        } else {
                            console.log('Error al guardar');
                        }
                    });
            }
        },

        editar: function (id) {

            var nombre = $('#nombre_editar' + id);
            var contrasena = $('#contrasena_editar' + id);
            var confirmar_contrasena = $('#confirmar_contrasena_editar' + id);
            var tipo = $('#tipo_usuario_editar' + id);
            var estado = $('#estado_editar' + id);

            this.validoVacioUsuario(nombre);
            this.validoVacioUsuario(contrasena);
            this.validoVacioUsuario(confirmar_contrasena);

            if (nombre.val().length >= 4 && contrasena.val().length >= 8 && this.validarContrasena(contrasena, confirmar_contrasena, id)) {
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Usuario/editarUsuario",
                    data: {
                        id: id,
                        nombre: nombre.val().toLowerCase().trim(),
                        contrasena: $.md5(contrasena.val()),
                        tipo: tipo.val(),
                        estado: estado.val()
                    }
                })
                    .done(function (r) {
                        console.log(' usuario actualizado -> ' + id);
                        $('#resultado').html(Escritorio.load.usuario());
                        $('.modal-backdrop').remove();
                    });
            } else {
                console.log('no edito' + id);
            }
        },

        eliminar: function (id) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Usuario/eliminarUsuario",
                data: {id: id}
            })
                .done(function (r) {
                    console.log('usuario eliminado');
                    $('#resultado').html(Escritorio.load.usuario());
                    $('.modal-backdrop').remove();
                });
        },

        verInactivos: function () {
            var check = $('#verInactivos');
            var tr = $('tr.inactivo');

            if (check.is(":checked")) {
                tr.removeClass(' ocultoInactivo');
                tr.children().children('.btn-danger').addClass(' oculto')
            } else {
                tr.addClass(' ocultoInactivo');
                tr.children().children('.btn-danger').removeClass(' oculto')
            }

        },
        buscar: function () {
            var filtro = $('#filtro_usuario');
            var valor_a_buscar = $('#valor_a_buscar');

            var tds = $('#tabla_usuario  td:nth-of-type(' + filtro.val() + ')');

            tds.each(function (i, td) {

                var texto_td = td.innerHTML.toString();
                var que_busco = valor_a_buscar.val().toString();

                //if (texto_td == que_busco) {
                if (texto_td.indexOf(que_busco) > -1) {
                    console.log('encontro -> ' + texto_td);
                    $(td).parents('tr').removeClass(' ocultoFiltro');
                } else {
                    $(td).parents('tr').addClass(' ocultoFiltro');
                }
            });

            Usuario.acciones.verInactivos();
        },

        limpiar: function () {
            var input_nombre = $('#nombre');
            var contrasena = $('#contrasena');
            var confirmar_contrasena = $('#confirmar_contrasena');

            input_nombre.val('');
            contrasena.val('');
            confirmar_contrasena.val('');
            $('#nombre_vacio').addClass(' oculto');
            $('#nombre_error').addClass(' oculto');
            $('#contrasena_vacio').addClass(' oculto');
            $('#contrasena_error').addClass(' oculto');
            $('#confirmar_contrasena_vacio').addClass(' oculto');
            $('#confirmar_contrasena_error').addClass(' oculto');
            $('#contrasena_no_coinciden').addClass(' oculto');

            input_nombre.parents('.agrupador').removeClass(' has-error has-warning');
            contrasena.parents('.agrupador').removeClass(' has-error has-warning');
            confirmar_contrasena.parents('.agrupador').removeClass(' has-error has-warning');
        },

        limpiarEditar: function () {
            $('#resultado').html(Escritorio.load.usuario());
            $('.modal-backdrop').remove();
        },

        validarContrasena: function (input_contrasena, input_confirmar, id) {
            console.log(input_contrasena.val().trim() + ' == ' + input_confirmar.val().trim());
            if (input_contrasena.val().trim() == input_confirmar.val().trim()) {
                ( id == -1 ) ?
                    $('#contrasena_no_coinciden').addClass(' oculto') :
                    $('#contrasena_no_coinciden_editar' + id).addClass(' oculto');
                return true;
            } else {
                ( id == -1 ) ?
                    $('#contrasena_no_coinciden').removeClass(' oculto') :
                    $('#contrasena_no_coinciden_editar' + id).removeClass(' oculto');
                return false;
            }
        },

        validarNumeroCaracteresUsuario: function (elem, numero) {
            Usuario.acciones.mensajeNumeroCaracteresUsuario(elem, numero);
            $(elem).parents('.agrupador').children('.form-group').children('.mensaje').children('.vacio').addClass(' oculto');

            if ($(elem).val().length < numero) {
                $(elem).parents('.agrupador').removeClass(' has-error');
                $(elem).parents('.agrupador').addClass(' has-warning');
                $(elem).parents('.agrupador').children('.vacio').addClass(' oculto');
            }
            else {
                $(elem).parents('.agrupador').removeClass(' has-warning');
            }
        },

        validoVacioUsuario: function (elem) {
            if (elem.val() == '') {
                elem.parents('.agrupador').addClass(' has-error');
                elem.parents('.agrupador').children('.form-group').children('.mensaje').children('.vacio').removeClass(' oculto');
                $(elem).parents('.agrupador').children('.form-group').children('.mensaje').children('.error').removeClass(' oculto');
            } else {
                elem.parents('.agrupador').children('.form-group').children('.mensaje').children('.vacio').addClass(' oculto');
            }
        },

        mensajeNumeroCaracteresUsuario: function (elem, numero) {
            if ($(elem).val().length < numero) {
                $(elem).parents('.agrupador').children('.form-group').children('.mensaje').children('.error').removeClass(' oculto');
            } else {
                $(elem).parents('.agrupador').children('.form-group').children('.mensaje').children('.error').addClass(' oculto');
                $(elem).parents('.agrupador').children('.form-group').children('.mensaje').children('.vacio').addClass(' oculto');
            }
        },

        getUsuarioIdByNombre: function () {
            var usuario_nombre = $('#ticket_usuario_nombre').val();
            console.log('busco usuario -> '+usuario_nombre);
            if (usuario_nombre.length != '') {
                $.ajax({
                    method: "POST",
                    url: "http://mybici.server/Usuario/getUsuarioIdByNombre/" + usuario_nombre,
                    data: {}
                })
                    .done(function (r) {
                        if (r.status) {
                            $('#ticket_usuario_codigo').val(r.usuario_id);
                            Estacion.mensajes.oculta($('#usuario_no_existe'));
                        } else {
                            $('#ticket_usuario_codigo').val('-');
                            Estacion.mensajes.mostrar($('#usuario_no_existe'));
                        }
                    });
            } else {
                $('#ticket_usuario_codigo').val('-');
                Estacion.mensajes.mostrar($('#usuario_no_existe'));
            }
        }

    }
};
