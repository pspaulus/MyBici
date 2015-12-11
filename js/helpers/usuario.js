var Usuario = {

    acciones: {
        guardar: function () {
            var nombre = $('#nombre').val().toLowerCase().trim();
            var contrasena = $('#contrasena').val().trim();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona/ingresarUsuario",
                data: {nombre: nombre, contrasena: $.md5(contrasena)}
            })
                .done(function (r) {
                    console.log(nombre + '\n' + contrasena + '\n');
                });
        },

        eliminar: function (id) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona/eliminarUsuario",
                data: {id: id}
            })
                .done(function (r) {
                    console.log('eliminado -> ' + id);
                });
        },

        editar: function (id) {
            var nombre = $('#nombre_editar').val().toLowerCase().trim();
            var contrasena = $('#contrasena_editar').val().trim();
            var estado = $('#estado_editar').val();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona/editarUsuario",
                data: {id: id, nombre: nombre, contrasena: $.md5(contrasena), estado: estado}
            })
                .done(function (r) {
                    console.log('editar -> ' + id);
                });
        },

        limpiar: function () {
            $('#nombre').val('');
            $('#contrasena').val('');
            $('#confirmar_contrasena').val('');
        }

    }
};
