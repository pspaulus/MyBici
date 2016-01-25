<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top sinBordeRedondeado" role="navigation">

        <!--Barra arriba-->
        <div class="navbar-header ">

            <!--boton menu cuando estas en celular-->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><i class="fa fa-fw fa-bicycle"></i> MyBici</a>
        </div>

        <!--Menu del usuario-->
        <ul class="nav navbar-right top-nav">
            <li>
                <a class="nav-texto">Bienvenido</a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $usuario_nombre ?> <b
                        class="caret"></b></a><input type="hidden" value="<?= $tdu ?>" id="tdu">
                <ul class="dropdown-menu">
                    <li>
                        <a onclick="Escritorio.Acciones.salir()"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                    </li>
                </ul>
            </li>
        </ul>

        <?php if (!Escritorio::verificarInternet()) { ?>
            <?php Escritorio::Mensaje('sin_conexion_internet') ?>
            <script>
                Escritorio.mensajeFlotante.mostrar($('#sin_conexion_internet'));
            </script>
        <?php } ?>

        <!--Men� lateral izquierdo-->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="#page_ticket" onclick="$('.navbar-toggle').click(); Escritorio.load.ticket();">
                        <i class="fa fa-fw fa-ticket"></i> Tickets
                    </a>
                </li>
                <li>
                    <a href="#page_inventario" onclick="$('.navbar-toggle').click(); Escritorio.load.inventario()">
                        <i class="fa fa-fw fa-bicycle"></i> Inventario
                    </a>
                </li>
                <li>
                    <a href="#page_estacionamiento" onclick="$('.navbar-toggle').click(); Escritorio.load.estacionamiento()">
                        <i class="fa fa-fw fa-product-hunt"></i> Estacionamientos
                    </a>
                </li>
                <li>
                    <a href="#page_estacion" onclick="$('.navbar-toggle').click(); Escritorio.load.estacion()">
                        <i class="fa fa-fw fa-home"></i> Estaciones
                    </a>
                </li>
<!--                <li>-->
<!--                    <a onclick="$('.navbar-toggle').click(); Escritorio.load.evento()">-->
<!--                        <i class="fa fa-fw fa-trophy"></i> Eventos-->
<!--                    </a>-->
<!--                </li>-->
                <li>
                    <a href="#page_usuario" onclick="$('.navbar-toggle').click(); Escritorio.load.usuario()">
                        <i class="fa fa-fw fa-users"></i> Usuarios
                    </a>
                </li>
                <!--                <li>-->
                <!--                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-list"></i>-->
                <!--                        Tablas Auxiliares<i class="fa fa-fw fa-caret-down"></i></a>-->
                <!--                    <ul id="demo" class="collapse">-->
                <!--                        <li>-->
                <!--                            <a onclick="Escritorio.load.marca()"><i class="fa fa-fw fa-star"></i> Marca</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a onclick="Escritorio.load.modelo()"><i class="fa fa-fw fa-cube"></i> Modelo</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a onclick="Escritorio.load.estado()"><i class="fa fa-fw fa-tasks"></i> Estados</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </li>-->
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="scroll">
        <div class="container-fluid">
            <div class="col-xs-12">&nbsp;</div>
            <div id="resultado">

                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 text-center">
                        <h2 class="page-header">Sistema de Gesti&oacute;n para Pr&eacute;stamos de Bicicletas</h2>
                    </div>
                </div>

                <div class="row" id="segmento_mapa">
                    <div class="col-xs-12">
                        <?php if (Escritorio::verificarInternet()) { ?>
                            <?php $Escritorio = new Escritorio(); ?>
                            <?php $Escritorio->load->view('mapas_estaciones'); ?>
                        <?php } else {
                            Escritorio::Mensaje('no_muestra_contenido');
                        } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>