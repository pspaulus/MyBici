<div class="modal fade bs-example-modal-sm" id="eliminarUsuario_<?= $obj_usuario->id ?>" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                &iquest;Est&aacute; seguro eliminar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary"
                        onclick="Usuario.acciones.eliminar(<?= $obj_usuario->id ?>)" data-dismiss="modal">Si
                </button>
            </div>
        </div>
    </div>
</div>