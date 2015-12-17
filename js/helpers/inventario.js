var Inventario = {
    acciones: {

        refrescar: function () {
            $('#resultado').html(Escritorio.load.inventario());
        }
    }
};