<div class="row">

    <div class="col-xs-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-circle fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketVigentesHoy(); ?></div>
                        <div><strong>Generadas</strong></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xs-3">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('en_curso'); ?></div>
                        <div><strong>En curso</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('realizadas'); ?></div>
                        <div><strong>Realizadas</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-times-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('anuladas'); ?></div>
                        <div><strong>Anuladas</strong></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>