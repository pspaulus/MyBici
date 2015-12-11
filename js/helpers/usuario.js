var Usuario = {

    acciones: {
        guardar: function () {
            var nombre = $('#nombre').val().toLowerCase().trim();
            var contrasena = $('#contrasena').val().trim();
            var tipo = $('#tipo_usuario').val();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona/ingresarUsuario",
                data: {nombre: nombre, contrasena: $.md5(contrasena), tipo: tipo}
            })
                .done(function (r) {
                    if (r.status){
                        console.log('usuario guardaro');
                        Escritorio.load.persona();

                    } else{
                        console.log('NO guarda');
                    }
                });
        },

        eliminar: function (id, el) {
            $.ajax({
                method: "POST",
                url: "http://mybici.server/Persona/eliminarUsuario",
                data: {id: id}
            })
                .done(function (r) {

                    Escritorio.load.persona();
                    //if (r.JSON.status) {
                    //    $(el).up('tr').class("ocultar");
                    //}
                    //
                    //alert(r.JSON.status);
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
                    Escritorio.load.persona();
                    console.log('editar -> ' + id);
                });
        },

        verInactivos: function () {
            var check = $('#verInactivos');

            if (check.is(":checked")) {
                $('tr.inactivo').removeClass(' ocultoInactivo');
            } else {
                $('tr.inactivo').addClass(' ocultoInactivo');
            }

            //console.log('ver inactivos -> ' + check.is(":checked"));
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
            $('#nombre').val('');
            $('#contrasena').val('');
            $('#confirmar_contrasena').val('');
        },

        update: function (id) {
            var nombre = $('#nombre_editar').val().toLowerCase().trim();
            var contrasena = $('#contrasena_editar').val().trim();
            var estado = $('#estado_editar').val();

            $.ajax({
                method: "POST",
                url: "http://mybici.server/api/collection",
                data: {
                    model: 'Usuario',
                    type: 'yaml',
                }
            })
                .done(function (r) {
                    console.log('editar -> ' + id);
                });
        }
    }
};
