<div class="row">

    <div class="col-xs-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketVigentesHoy(); ?></div>
                        <div><strong>Vigentes</strong></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xs-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('realizadas'); ?></div>
                        <div>Realizadas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-times-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('anuladas'); ?></div>
                        <div>Anuladas</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>