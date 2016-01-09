base_url = 'http://192.168.100.14/';
//base_url = 'http://mybici.server/';

var Login = {

    index: {

        /**
         * Validar usuari|o al presionar ingresar en el logeo
         */
        validarUsuario: function () {
            var input_usuario = $('#usuario');
            var input_contrasena = $('#contrasena');

            this.validoVacio(input_usuario);
            this.validoVacio(input_contrasena);

            if (input_usuario.val().length >= 4 && input_contrasena.val().length >= 8) {
                $.ajax({
                    method: "POST",
                    url: base_url+"Login/validarUsuario",
                    data: {
                        usuario: input_usuario.val().toLowerCase().trim(),
                        contrasena: $.md5(input_contrasena.val().trim())
                    }
                })
                    .done(function (r) {
                        if (r.status) {
                            Login.index.mensajeUsuarioContrasenaIncorrecto(r.status);
                        } else {
                            window.location.replace(base_url+"Escritorio");
                        }
                    });
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

    }
};
