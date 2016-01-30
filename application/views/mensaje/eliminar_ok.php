<div id="eliminar_ok" class="col-xs-10 col-xs-offset-1 oculto">
    <div class="alert alert-success text-center mensajeFlotanteCuerpo">
        <?php if (!empty($entidad)) {
            switch ($entidad) {
                case 'usuario':
                    $contenido = '<strong>OK: </strong> Usuario marcado como inactivo';
                    break;

                case 'estacionamiento':
                    $contenido = '<strong>OK: </strong> Bicicleta retirada del estaciomiento';
                    break;

                case 'ticket':
                    $contenido = '<strong>OK: </strong> Ticket anulado';
                    break;
            }
            echo $contenido;
        } else {
            $contenido = '<strong>OK: </strong> Registro eliminado con exito.';
        }?>
    </div>
</div>