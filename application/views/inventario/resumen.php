

<div class="row">
    <div class="col-xs-6 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-circle-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $Bicicletas->contarBicicletasEstado('en_uso'); ?></div>
                        <div><strong>En uso</strong></div>
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
                        <div class="huge"><?= $Bicicletas->contarBicicletasEstado('buena'); ?></div>
                        <div><strong>Buenas</strong></div>
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
                        <div class="huge"><?= $Bicicletas->contarBicicletasEstado('reparar'); ?></div>
                        <div><strong>En reparaci&oacute;n</strong></div>
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
                        <div class="huge"><?= $Bicicletas->contarBicicletasEstado('danada'); ?></div>
                        <div><strong>Da&ntilde;ada</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>