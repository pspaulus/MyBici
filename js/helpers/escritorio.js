var Escritorio = {
    load: {

        ticket: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "Ticket",
                beforeSend: function () {
                    container.html(
                    '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                    '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        inventario: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "inventario",
                beforeSend: function () {
                    container.html(
                        '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        usuario: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "Usuario",
                beforeSend: function () {
                    container.html(
                        '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        estacion: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "Estacion",
                beforeSend: function () {
                    container.html(
                        '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        evento: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "Evento",
                beforeSend: function () {
                    container.html(
                        '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        marca: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "Marca",
                beforeSend: function () {
                    container.html(
                        '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        modelo: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "Modelo",
                beforeSend: function () {
                    container.html(
                        '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        estado: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: base_url + "Estado",
                beforeSend: function () {
                    container.html(
                        '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                        '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                        '</div>');
                }
            })
                .done(function (r) {
                    container.html(r);
                });
        }
    },

    Acciones: {

        salir: function () {
            $.ajax({
                method: "POST",
                url: base_url + "Escritorio/salir"
            })
                .done(function () {
                    window.location.replace(base_url + "Login");
                });
        },

        ocultarMostrar: function (elemento, titulo) {
            elemento.slideToggle();
            titulo.toggleClass('active', 'inactive')
        },

        refrescar: function() {
            $('#segmento_mapa').html(
                '<div class="col-xs-12 text-center" class="espacioArribaFijo">' +
                '<i class="fa fa-spinner fa-spin fa-3x"></i>' +
                '</div>');
            location.reload();
        }
    },

    Validaciones: {

        soloLetras: function (e) {
            var key = e.keyCode || e.which;
            var tecla = String.fromCharCode(key).toLowerCase();
            var letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            var especiales = "8-37-39-46";

            var tecla_especial = false;
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        },

        soloNumeros: function (e) {
            var key = e.keyCode || e.which;
            var tecla = String.fromCharCode(key).toLowerCase();
            var letras = "0123456789";
            var especiales = "8-37-39-46";

            var tecla_especial = false;
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        },

        soloNumerosSimbolo: function (e) {
            var key = e.keyCode || e.which;
            var tecla = String.fromCharCode(key).toLowerCase();
            var letras = "0123456789-.";
            var especiales = "8-37-39-46";

            var tecla_especial = false;
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    },

    mensajeFlotante: {
        mostrar: function (mensaje) {
            if (mensaje) {
                mensaje.fadeIn();
                mensaje.delay(4000).fadeOut(500);
            }
        }
    }
};
