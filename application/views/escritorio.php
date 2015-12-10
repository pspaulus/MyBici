<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!--Barra arriba-->
        <div class="navbar-header">

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
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $usuario ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a onclick="Escritorio.Acciones.salir()"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                    </li>
                </ul>
            </li>
        </ul>


        <!--Menú lateral izquierdo-->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
<!--                <li class="active">-->
                <li>
                    <a onclick="Escritorio.load.ticket()"><i class="fa fa-fw fa-ticket"></i> Reservas</a>
                </li>
                <li>
                    <a onclick="Escritorio.load.inventario()"><i class="fa fa-fw fa-bicycle"></i> Inventario</a>
                </li>
                <li>
                    <a onclick="Escritorio.load.persona()"><i class="fa fa-fw fa-users"></i> Usuarios</a>
                </li>
                <li>
                    <a onclick="Escritorio.load.estacion()"><i class="fa fa-fw fa-map-marker"></i> Estaciones</a>
                </li>
                <li>
                    <a onclick="Escritorio.load.evento()"><i class="fa fa-fw fa-envelope"></i> Eventos</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-list"></i> Tablas Auxiliares<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a onclick="Escritorio.load.marca()"><i class="fa fa-fw fa-star"></i> Marca</a>
                        </li>
                        <li>
                            <a onclick="Escritorio.load.modelo()"><i class="fa fa-fw fa-cube"></i> Modelo</a>
                        </li>
                        <li>
                            <a onclick="Escritorio.load.estado()"><i class="fa fa-fw fa-tasks"></i> Estados</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="resultado">
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 text-center">
                        <h2 class="page-header">Sistema de Gesti&oacute;n de Alquiler de Bicicletas</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <ol class="breadcrumb">
                            <li class="active">
                                Bienvenido <?= ucfirst($usuario)?>
                            </li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>