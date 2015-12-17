<div class="row">
    <div class="col-xs-6 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-circle-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $Bicicletas->contarBicicletas(); ?></div>
                        <div>Total</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xs-6 col-sm-3">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check-circle-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $Bicicletas->contarBicicletasEstado('disponibles'); ?></div>
                        <div>Disponibles</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-sm-3">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-times-circle-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $Bicicletas->contarBicicletasEstado('mantenimiento'); ?></div>
                        <div>En mantenimiento</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-sm-3">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-times-circle-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $Bicicletas->contarBicicletasEstado('en_uso'); ?></div>
                        <div>En uso</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>