<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-fw fa-ticket"></i> Reservas
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-clock-o"></i> Hoy: <?= date('Y-m-d');?> <button class="btn btn-xs btn-default" type="button"><i class="fa fa-refresh"></i></button>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-circle-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">26</div>
                                <div>Vigentes</div>
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
                                <div class="huge">12</div>
                                <div>Culminadas</div>
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
                                <div class="huge">13</div>
                                <div>Anuladas</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-search"></i> Buscar
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                <select class="form-control">
                    <option>ID</option>
                    <option>Nombre</option>
                </select>
            </div>
            <div class="col-xs-8">

                <div class="form-group input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                </div>
            </div>
            <div class="col-xs-12">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <td>001</td>
                            <td>lorem ipsum</td>
                            <td>Retiro</td>
                            <td>Llegada</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="success">
                            <td>002</td>
                            <td>lorem ipsum</td>
                            <td>Retiro</td>
                            <td>Llegada</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="warning">
                            <td>003</td>
                            <td>lorem ipsum</td>
                            <td>Retiro</td>
                            <td>Llegada</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>004</td>
                            <td>lorem ipsum</td>
                            <td>Retiro</td>
                            <td>Llegada</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>005</td>
                            <td>lorem ipsum</td>
                            <td>Retiro</td>
                            <td>Llegada</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>006</td>
                            <td>lorem ipsum</td>
                            <td>Retiro</td>
                            <td>Llegada</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>