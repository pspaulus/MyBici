<div id="restaurar_ok" class="col-xs-10 col-xs-offset-1 mensajeFlotantecabecera oculto">
    <div class="alert alert-success text-center mensajeFlotanteCuerpo">
        <?php if (!empty($entidad)) {
            switch ($entidad) {
                case 'usuario':
                    $contenido = '<strong>OK: </strong> Usuario restaurado con &eacute;xito.';
                    break;
            }
            echo $contenido;
        } else {
            $contenido = '<strong>OK: </strong> Restaurado con &eacute;xito.';
        }?>

    </div>
</div>