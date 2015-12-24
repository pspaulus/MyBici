<div class="modal fade bs-example-modal-sm" id="marcarEstadoRealizada_<?= $ticket->id ?>" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                &iquest;Est&aacute; seguro marcar ticket como "Realizada"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary"
                        onclick="Ticket.acciones.cambiarEstado(<?= $ticket->id ?>, 'realizada')" data-dismiss="modal">Si
                </button>
            </div>
        </div>
    </div>
</div>