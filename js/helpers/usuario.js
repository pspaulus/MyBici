var Usuario = {

    acciones: {

        cargarVistaListaUsuario: function () {
            var filtro = $('#filtro_usuario').val();
            var valor_a_buscar = $('#valor_a_buscar').val();
            var ver_inactivos = $('#verInactivos');
            var tdu = $('#tdu').val();

            var inactivos = false;
            if (ver_inactivos.is(":checked")) {
                inactivos = true;
            }

            $.ajax({
                method: "POST",
                url: base_url + "Usuario/cargarVistaListaUsuario/",
                data: {
                    filtro: filtro,
                    valor_a_buscar: valor_a_buscar,
                    ver_inactivos: inactivos,
                    tdu: tdu
                },
                beforeSend: function () {
                    $('#listado_usuario').html(
                        '<div class="col-xs-12 text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>'
                    );
                }
            })
                .done(function (r) {
                    $('#listado_usuario').html(r);
                })
        },

        pressEnter: function (e) {
            if (e.keyCode == 13) {
                console.log('Presiona enter');
                Usuario.acciones.cargarVistaListaUsuario();
            }
        },

        existeUsuario: function (nombre) {
            if (nombre.val().length >= 4) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Usuario/existeUsuario/" + nombre.val(),
                    data: {},
                    beforeSend: function () {
                        $('#busy_nombre').html(
                            '<i class="fa fa-spinner fa-spin fa-1x"></i>'
                        );
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('ERROR: existe usuario');
                            $('#existeUsuario').val(0);
                            Estacion.mensajes.mostrar($('#nombre_duplicado'));
                        } else {
                            console.log('OK: No existe usuario');
                            $('#existeUsuario').val(1);
                            Estacion.mensajes.oculta($('#nombre_duplicado'));
                        }
                        $('#busy_nombre').html('');
                    });
            }
        },


        guardar: function () {
            var botones_modal_crear = $('#botones_modal_crear');
            var nombre = $('#nombre').val().trim();
            var contrasena = $('#contrasena').val().trim();
            var confirmar_contrasena = $('#confirmar_contrasena').val().trim();
            var tipo = $('#tipo_usuario').val();
            var existeUsuario = $('#existeUsuario').val();

            var validacion_nombre = true;
            var validacion_contrasena = true;
            var validacion_confirmar_contrasena = true;
            var validacion_coincide_contrasena = true;

            if (nombre == '') {
                validacion_nombre = false;
                Estacion.mensajes.mostrar($('#nombre_vacio'));
            } else {
                if (nombre.length < 4) {
                    validacion_nombre = false;
                    Estacion.mensajes.mostrar($('#nombre_error'));
                }
            }

            if (contrasena == '') {
                validacion_contrasena = false;
                Estacion.mensajes.mostrar($('#contrasena_vacio'));
            } else {
                if (contrasena.length < 8) {
                    validacion_contrasena = false;
                    Estacion.mensajes.mostrar($('#contrasena_error'));
                }
            }

            if (confirmar_contrasena == '') {
                validacion_confirmar_contrasena = false;
                Estacion.mensajes.mostrar($('#confirmar_contrasena_vacio'));
            }

            if (validacion_contrasena && validacion_confirmar_contrasena) {
                validacion_coincide_contrasena = this.validarContrasena(contrasena, confirmar_contrasena);
            }

            if ((existeUsuario == 1) && validacion_nombre && validacion_contrasena && validacion_confirmar_contrasena
                && validacion_coincide_contrasena) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Usuario/ingresarUsuario",
                    data: {
                        nombre: nombre.toLowerCase(),
                        contrasena: $.md5(contrasena),
                        tipo: tipo
                    },
                    beforeSend: function () {
                        Escritorio.Acciones.mostrarBusy(botones_modal_crear, -1);
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            console.log('OK: usuario guardado');
                            Usuario.acciones.limpiar();
                            $('#agregarUsuario').modal('toggle');
                            Usuario.acciones.cargarVistaListaUsuario();
                            Escritorio.mensajeFlotante.mostrar($('#guardar_ok'));
                        } else {
                            console.log('ERROR: no al guardar');
                            Usuario.acciones.cargarVistaListaUsuario();
                            Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                        }
                        Escritorio.Acciones.ocultarBusy(botones_modal_crear, -1);
                    });
            } else {
                console.log('ERROR: no guarda por validaciones');
            }
        },

        editar: function (id) {
            var botones_modal_editar = $('#botones_modal_editar' + id);
            //var inactivos = $('#verInactivos');
            //var nombre = $('#nombre_editar' + id);
            var contrasena = $('#contrasena_editar' + id).val().trim();
            var confirmar_contrasena = $('#confirmar_contrasena_editar' + id).val().trim();
            var tipo = $('#tipo_usuario_editar' + id).val();
            var estado = $('#estado_editar' + id).val();

            var validacion_contrasena = true;
            var validacion_confirmar_contrasena = true;
            var validacion_coincide_contrasena = true;

            if (contrasena == '') {
                validacion_contrasena = false;
                Estacion.mensajes.mostrar($('#contrasena_vacio_' + id));
            } else {
                if (contrasena.length < 8) {
                    validacion_contrasena = false;
                    Estacion.mensajes.mostrar($('#contrasena_error_' + id));
                }
            }

            if (confirmar_contrasena == '') {
                validacion_confirmar_contrasena = false;
                Estacion.mensajes.mostrar($('#confirmar_contrasena_vacio_' + id));
            }

            if (validacion_contrasena && validacion_confirmar_contrasena) {
                validacion_coincide_contrasena = this.validarEditarContrasena(contrasena, confirmar_contrasena, id);
            }

            //this.validoVacio(nombre);
            //this.validoVacio(contrasena);
            //this.validoVacio(confirmar_contrasena);

            //if (nombre.val().length >= 4 && contrasena.val().length >= 8 && this.validarEditarContrasena(contrasena, confirmar_contrasena, id)) {
            if ( validacion_contrasena && validacion_confirmar_contrasena && validacion_coincide_contrasena) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Usuario/editarUsuario",
                    data: {
                        id: id,
                        contrasena: $.md5(contrasena),
                        tipo: tipo,
                        estado: estado
                    }
                })
                    .done(function (r) {
                        console.log(r.mensaje);
                        Usuario.acciones.cargarVistaListaUsuario();
                        if(r.status){
                            Escritorio.mensajeFlotante.mostrar($('#editar_ok'));
                        } else {
                            Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                        }
                    });
            } else {
                console.log('ERROR: no edita por validadciones');
            }
        },

        eliminar: function (id) {
            $.ajax({
                method: "POST",
                url: base_url + "Usuario/eliminarUsuario",
                data: {id: id}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('OK: usuario eliminado');
                        $('#eliminarUsuario_' + id).modal('toggle');
                        Usuario.acciones.cargarVistaListaUsuario();
                        Escritorio.mensajeFlotante.mostrar($('#eliminar_ok'));
                    } else {
                        Usuario.acciones.cargarVistaListaUsuario();
                        Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                    }
                });
        },

        restaurar: function (id) {
            $.ajax({
                method: "POST",
                url: base_url + "Usuario/restaurar/",
                data: {id: id}
            })
                .done(function (r) {
                    if (r.status) {
                        console.log('ERROR: restaura usuario -> ' + r.usuario_id);
                        Usuario.acciones.cargarVistaListaUsuario();
                        Escritorio.mensajeFlotante.mostrar($('#restaurar_ok'));
                    } else {
                        console.log('OK: No restaura usuario');
                        Usuario.acciones.cargarVistaListaUsuario();
                        Escritorio.mensajeFlotante.mostrar($('#error_mensaje'));
                    }
                });
        },

        verInactivos: function () {
            var check = $('#verInactivos');
            var tr = $('tr.inactivo');

            if (check.is(":checked")) {
                tr.removeClass(' ocultoInactivo');
                tr.children().children('.btn-danger').addClass(' oculto');
                tr.children().children('.btn-warning').addClass(' oculto');
            } else {
                tr.addClass(' ocultoInactivo');
                tr.children().children('.btn-danger').removeClass(' oculto');
                tr.children().children('.btn-warning').removeClass(' oculto');
                tr.children().children('.btn-default').removeClass(' oculto');
            }
            $('.modal-backdrop').remove();
        },
        /*
         buscar: function (tipo) {
         Usuario.acciones.cargarVistaListaUsuario();


         //filtra por js en vez de cargar el listado desde el server con los criterios como parametros
         //las otras app tan de la otra manera es decir desde el server se filtra
         Usuario.acciones.filtrar();
         },

         filtrar: function() {
         var filtro = $('#filtro_usuario');
         var valor_a_buscar = $('#valor_a_buscar');

         var tds = $('#tabla_usuario  td:nth-of-type(' + filtro.val() + ')');

         tds.each(function (i, td) {

         var texto_td = td.innerHTML.toString();
         var que_busco = valor_a_buscar.val().toString();

         if (texto_td.indexOf(que_busco) > -1) {
         $(td).parents('tr').removeClass(' ocultoFiltro');
         } else {
         $(td).parents('tr').addClass(' ocultoFiltro');
         }
         });

         Usuario.acciones.verInactivos();
         },
         */
        limpiar: function () {
            var input_nombre = $('#nombre');
            var input_contrasena = $('#contrasena');
            var input_confirmar_contrasena = $('#confirmar_contrasena');
            var select_tipo = $('#tipo_usuario');
            var select_estado = $('#estado');

            input_nombre.val('');
            input_contrasena.val('');
            input_confirmar_contrasena.val('');
            select_tipo.prop('selectedIndex', 0);
            select_estado.prop('selectedIndex', 0);

            Estacion.mensajes.oculta($('#nombre_vacio'));
            Estacion.mensajes.oculta($('#nombre_error'));
            Estacion.mensajes.oculta($('#nombre_duplicado'));

            Estacion.mensajes.oculta($('#contrasena_vacio'));
            Estacion.mensajes.oculta($('#contrasena_error'));
            Estacion.mensajes.oculta($('#error_mayuscula'));
            Estacion.mensajes.oculta($('#error_numero'));

            Estacion.mensajes.oculta($('#confirmar_contrasena_vacio'));
            Estacion.mensajes.oculta($('#contrasena_no_coinciden'));
        },

        limpiarEditar: function () {
            Usuario.acciones.cargarVistaListaUsuario();
        },

        validarContrasena: function (contrasena, confirmar_contrasena) {
            var validacion_igual = true;
            var validacion_numero = true;
            var validacion_mayuscula = true;

            if (contrasena != confirmar_contrasena) {
                console.log('ERROR: contrasena no coincide -> ' + contrasena + ' =/= ' + confirmar_contrasena);
                Estacion.mensajes.mostrar($('#contrasena_no_coinciden'));
                validacion_igual = false;
            }

            if (!contrasena.match(/[A-Z]/)) {
                console.log('ERROR: contrasena sin mayuscula');
                Estacion.mensajes.mostrar($('#error_mayuscula'));
                validacion_numero = false;
            }

            if (!contrasena.match(/\d/)) {
                console.log('ERROR: contrasena sin numero');
                Estacion.mensajes.mostrar($('#error_numero'));
                validacion_mayuscula = false;
            }

            return (validacion_igual && validacion_numero && validacion_mayuscula);
        },

        validarEditarContrasena: function (contrasena, confirmar_contrasena, id) {
            var validacion_igual = true;
            var validacion_numero = true;
            var validacion_mayuscula = true;

            console.log(contrasena + ' == ' + confirmar_contrasena);
            if (contrasena.length == 32 && contrasena.match(/[a-z0-9]/) &&
                confirmar_contrasena.length == 32 && confirmar_contrasena.match(/[a-z0-9]/)) {
                return true;
            } else {
                console.log('ERROR: no es MD5, nueva contrasena');
                if (contrasena != confirmar_contrasena) {
                    console.log('ERROR: contrasena no coincide -> ' + contrasena + ' =/= ' + confirmar_contrasena);
                    Estacion.mensajes.mostrar($('#contrasena_no_coinciden_' + id));
                    validacion_igual = false;
                }

                if (!contrasena.match(/[A-Z]/)) {
                    console.log('ERROR: contrasena sin mayuscula');
                    Estacion.mensajes.mostrar($('#error_mayuscula_' + id));
                    validacion_numero = false;
                }

                if (!contrasena.match(/\d/)) {
                    console.log('ERROR: contrasena sin numero');
                    Estacion.mensajes.mostrar($('#error_numero_' + id));
                    validacion_mayuscula = false;
                }

                return (validacion_igual && validacion_numero && validacion_mayuscula);

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

        validoVacio: function (elem) {
            if (elem.val() == '') {
                elem.parents('.agrupador').addClass(' has-error');
                elem.parents('.agrupador').children('.form-group').children('.mensaje').children('.vacio').removeClass(' oculto');

                $('#nombre_vacio').removeClass(' oculto');
                $('#nombre_error').removeClass(' oculto');
                $('#contrasena_vacio').removeClass(' oculto');
                $('#contrasena_error').removeClass(' oculto');
                $('#confirmar_contrasena_vacio').removeClass(' oculto');
                $('#confirmar_contrasena_error').removeClass(' oculto');
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
            console.log('busco usuario -> ' + usuario_nombre);
            if (usuario_nombre.length != '') {
                $.ajax({
                    method: "POST",
                    url: base_url + "Usuario/getUsuarioIdByNombre/" + usuario_nombre,
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
