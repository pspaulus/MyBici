<div class="row">

    <div class="col-xs-6 col-sm-3">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-circle fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketVigentesHoy($estacion_id); ?></div>
                        <div><strong>Generados</strong></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xs-6 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('en_curso',$estacion_id); ?></div>
                        <div><strong>En curso</strong></div>
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
                        <i class="fa fa-check-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('realizadas',$estacion_id); ?></div>
                        <div><strong>Realizados</strong></div>
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
                        <i class="fa fa-times-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Ticket::contarTicketHoyByEstado('anuladas',$estacion_id); ?></div>
                        <div><strong>Anulados</strong></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>