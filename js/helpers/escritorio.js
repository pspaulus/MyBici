var Escritorio = {
    load: {

        ticket: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Ticket",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.innerHTML= '';
                    container.html(r);
                });
        },

        inventario: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Inventario",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        persona: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona",
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
                url: "http://mybici.server/Estacion",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },

        evento: function () {
            var container = $('#resultado');

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Evento",
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
                url: "http://mybici.server/Marca",
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
                url: "http://mybici.server/Modelo",
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
                url: "http://mybici.server/Estado",
                data: {datos: ""}
            })
                .done(function (r) {
                    container.html(r);
                });
        },
    },

    Acciones: {
        salir: function () {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Escritorio/salir"

            })
                .done(function (r) {
                    console.log(r);
                    window.location.replace("http://mybici.server/Login");
                });
        }

    },

    Validaciones:{
        soloLetras: function (e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";

            tecla_especial = false
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
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = "0123456789-.";
            especiales = "8-37-39-46";

            tecla_especial = false
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

