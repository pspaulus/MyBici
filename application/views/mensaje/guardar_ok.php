<div id="guardar_ok" class="col-xs-10 col-xs-offset-1 oculto">
    <div class="alert alert-success text-center mensajeFlotanteCuerpo">
        <?php if (!empty($entidad)) {
            switch ($entidad) {
                case 'usuario':
                    $contenido = '<i class="fa fa-check"></i> Usuario guardado con &eacute;xito.';
                    break;

                case 'estacion':
                    $contenido = '<i class="fa fa-check"></i> Estaci&oacute;n creado con &eacute;xito.';
                    break;

                case 'estacionamiento':
                    $contenido = '<i class="fa fa-check"></i> Bicicleta estacionada.';
                    break;

                case 'bicicleta':
                    $contenido = '<i class="fa fa-check"></i> Bicicleta agregrada con &eacute;xito.';
                    break;

                case 'ticket':
                    $contenido = '<i class="fa fa-check"></i> Ticket creado con &eacute;xito.';
                    break;

                case 'escritorio':
                    $contenido = '';
                    break;
            }
            echo $contenido;
        } else {
            $contenido = '<i class="fa fa-check"></i> Guardado con &eacute;xito.';
        }?>
    </div>
</div>