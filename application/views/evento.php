<div id="page-wrapper">
    <div class="container-fluid">

        <!--Titulo-->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-fw fa-envelope"></i> Evento
                </h1>
            </div>
        </div>

        <!--Subtitulo-->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-plus"></i> Agregar
                    </li>
                </ol>
            </div>
        </div>

        <!-- Button trigger Agregarmodal -->
        <div class="row form-control-espacio">
            <div class="col-lg-12">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarMarca" ><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <!-- Modal Agregar-->
        <div class="modal fade" id="agregarMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Marca</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label>ID</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control" type="text" placeholder="" value="001" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label for="Descripcion">Descripci&oacute;n</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control" id="Descripcion" type="text" placeholder="" value="BMX">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <label>Estado</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="form-control">
                                            <option>Activo</option>
                                            <option>Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal Eliminar-->
        <div class="modal fade bs-example-modal-sm" id="eliminarMarca" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        &iquest;Est&aacute; seguro eliminar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary">Si</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Subtitulo-->
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
            <div class="col-lg-12 text-right">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="">Incluir Elimnados
                    </label>
                </div>
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
                            <th>T&iacute;tulo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <td>001</td>
                            <td>lorem ipsum</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#eliminarMarca"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="success">
                            <td>002</td>
                            <td>lorem ipsum</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="warning">
                            <td>003</td>
                            <td>lorem ipsum</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>004</td>
                            <td>lorem ipsum</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>005</td>
                            <td>lorem ipsum</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-search"></i></button>
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i></button>
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