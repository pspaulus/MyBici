base_url = 'http://172.16.40.162/';
//base_url = 'http://192.168.100.15/';
//base_url = 'http://mybici.server/';

var Login = {

    index: {

        /**
         * Validar usuario al presionar ingresar en el logeo
         */
        validarUsuario: function () {
            var boton_ingresar = $('#boton_ingresar');
            var input_usuario = $('#usuario').val();
            var input_contrasena = $('#contrasena').val();

            var validacion_usuario = true;
            var validacion_contrasena = true;

            if (input_usuario == '') {
                validacion_usuario = false;
                Estacion.mensajes.mostrar($('#usuario_vacio'));
            } else {
                if (input_usuario.length < 4) {
                    validacion_usuario = false;
                    Estacion.mensajes.mostrar($('#usuario_error'));
                }
            }

            if (input_contrasena == '') {
                validacion_contrasena = false;
                Estacion.mensajes.mostrar($('#contrasena_vacio'));
            } else {
                if (input_contrasena.length < 8) {
                    validacion_contrasena = false;
                    Estacion.mensajes.mostrar($('#contrasena_error'));
                }
            }

            if (validacion_usuario && validacion_contrasena) {
                $.ajax({
                    method: "POST",
                    url: base_url + "Login/validarUsuario",
                    data: {
                        usuario: input_usuario.toLowerCase().trim(),
                        contrasena: $.md5(input_contrasena.trim())
                    },
                    beforeSend: function () {
                        Login.acciones.mostrarBusy(boton_ingresar,-1);
                    }
                })
                    .done(function (r) {
                        console.log(r.mensaje);
                        if (r.status) {
                            Estacion.mensajes.mostrar($('#usuario_contrasena_incorrecta'));
                        } else {
                            window.location.replace(base_url + "Escritorio");
                        }
                        Login.acciones.ocultarBusy(boton_ingresar,-1);
                    });
            } else {
                console.log('ERROR: no ingresa por validaciones');
            }
        },

        /**
         * Validar número de caracteres, esto valores los recibo de la vista (para usuario 4 y contraseña 8)
         * @param elem
         * @param numero
         */
        validarNumeroCaracteres: function (elem, numero) {
            Login.index.mensajeNumeroCaracteres(elem, numero);

            if ($(elem).val().length < numero) {
                $(elem).parents('.agrupador').removeClass(' has-error');
                $(elem).parents('.agrupador').addClass(' has-warning');
                $(elem).parents('.agrupador').children('.vacio').addClass(' oculto');
            }
            else {
                $(elem).parents('.agrupador').removeClass(' has-warning');
            }
        },

        /**
         * Valido si envian vacio
         * @param elem
         */
        validoVacio: function (elem) {
            if (elem.val() == '') {
                elem.parents('.agrupador').addClass(' has-error');
                elem.parents('.agrupador').children('.vacio').removeClass(' oculto');
                //$(elem).parents('.agrupador').children('.error').removeClass(' oculto');
            } else {
                elem.parents('.agrupador').children('.vacio').addClass(' oculto');
            }
        },

        /**
         * mostrar mensaje de caracteres incompletos
         * @param elem
         * @param numero
         */
        mensajeNumeroCaracteres: function (elem, numero) {
            if ($(elem).val().length < numero) {
                $(elem).parents('.agrupador').children('.error').removeClass(' oculto');
            } else {
                $(elem).parents('.agrupador').children('.error').addClass(' oculto');
            }
        },

        mensajeUsuarioContrasenaIncorrecto: function (bandera) {
            var mensaje = $('#usuario_contrasena_incorrecta');
            (bandera) ? mensaje.removeClass(' oculto') : mensaje.addClass(' oculto');
        },

        pressEnter: function (e) {
            if (e.keyCode == 13) {
                console.log('Presiona enter');
                Login.index.validarUsuario()
            }
        }

    },

    acciones: {
        mostrarBusy: function (contenedor,id) {
            contenedor.toggle();
            contenedor.parent().append(
                '<div id="busy_'+id+'" class="col-xs-12 text-center text-color-white">' +
                '<i class="fa fa-spinner fa-spin fa-2x"></i>' +
                '</div>');
            $('#usuario').attr('disabled');
            $('#contrasena').attr('disabled');
        },

        ocultarBusy: function (contenedor,id) {
            contenedor.toggle();
            contenedor.parent().children('#busy_'+id).remove();
            $('#usuario').removeAttr('disabled');
            $('#contrasena').removeAttr('disabled');
        }
    }
};
