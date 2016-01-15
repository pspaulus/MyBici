<div class="modal fade bs-example-modal-sm" id="marcarEstadoDanada_<?= $bicicleta->id ?>" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row contraer">
                    <div class="col-xs-12 text-center">
                        <label>&iquest;Est&aacute; seguro marcar la <span class="text-danger"><i class="fa fa-bicycle"></i> <?= Bicicleta::generarCodigo($bicicleta->id) ?></span> como <span class="text-danger">DA&Ntilde;ADA</span>?</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary"
                        onclick="Bicicleta.acciones.marcarEstado(<?= $bicicleta->id ?>, 'danada')" data-dismiss="modal">Si
                </button>
            </div>
        </div>
    </div>
</div>