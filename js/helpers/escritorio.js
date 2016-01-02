var ruta = 'http://mybici.server/';
var Escritorio = {
    load: {

        ticket: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta + "Ticket",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        inventario: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta + "inventario",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        usuario: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta + "Usuario",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        estacion: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta + "Estacion",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        evento:function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta + "Evento",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        marca: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta +"Marca",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        modelo: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta + "Modelo",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        estado: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: ruta + "Estado",
                data: {datos: ""}
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
                url: ruta + "Escritorio/salir"

            })
                .done(function (r) {
                    console.log(r);
                    window.location.replace(ruta + "Login");
                });
        },

        ocultarMostrar: function (elemento, titulo) {
            elemento.slideToggle();
            titulo.toggleClass('active', 'inactive')
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
    }
};
