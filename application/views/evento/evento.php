<?php $Evento = new Evento()?>

<!--Titulo-->
<div class="row" id="page_evento">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="fa fa-fw fa-envelope"></i> Evento
        </h1>
    </div>
</div>

<!-- Crear -->
<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active" id="titulo2" data-toggle="modal" data-target="#crearEvento">
                <a class="dedo">
                    <i class="fa fa-plus-circle"></i> Agregar
                </a>
            </li>
        </ol>
    </div>
</div>

<!-- Modal Agregar bicicleta -->
<?php $Evento->load->view('evento/crear', compact('Evento.php')); ?>
