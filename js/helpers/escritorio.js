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
        }

    }
};

