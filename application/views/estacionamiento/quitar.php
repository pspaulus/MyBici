<div class="modal fade bs-example-modal-sm" id="quitarBicicleta_<?= $estacionamiento->id  ?>" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                &iquest;Est&aacute; seguro quitar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary"
                        onclick="Estacionamiento.acciones.quitarBicicleta(<?= $estacionamiento->id ?>)"
                        data-dismiss="modal">Si
                </button>
            </div>
        </div>
    </div>
</div>