var Usuario = {


    acciones: {
        guardar: function () {
            var nombre = $('#nombre').val().trim();
            var contrasena = $('#contrasena').val().trim();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona/ingresarUsuario",
                data: {nombre: nombre, contrasena: $.md5(contrasena)}
            })
                .done(function (r) {
                    console.log(nombre+'\n'+contrasena+'\n');
                });
        },
        
        eliminar: function (id) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona/eliminarUsuario",
                data: {id: id}
            })
                .done(function (r) {
                    console.log('eliminado -> '+id);
                });
        },

        limpiar: function () {
            $('#nombre').val('');
            $('#contrasena').val('');
            $('#confirmar_contrasena').val('');
        }

    }
};
