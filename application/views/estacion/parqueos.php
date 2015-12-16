<?php //$Estacionamiento = new Estacionamiento(); dd($Estacionamiento); ?>

<div class="col-xs-12">
    <h3>Lista de parqueos - (Nombre del Estacionamiento)</h3>

    <div class="table-responsive">
        <table id="tabla_usuario" class="table table-hover">
            <thead>
            <tr>
                <th>N&uacute;mero</th>
                <th>Cod. Bicicleta</th>
                <th>Acciones</th>
            </tr>
            </thead>
<!--            --><?php //$estacionamientos = $Estacionamiento->cargarEstacionamientos(1, 'todos'); ?>
            <tbody>
<!--            --><?php //dd($estacionamientos); ?>
<!--            --><?php //foreach ($estacionamientos as $estacionamiento) { ?>
                <tr>
                    <td>GP001</td>
                    <td>GB001</td>
                    <td>
                        <button class="btn btn-sm btn-default" type="button" title="Agregar Bicicleta"><i
                                class="fa fa-plus"></i></button>
                        <button class="btn btn-sm btn-danger" type="button" title="Quitar Bicicleta"><i
                                class="fa fa-minus"></i></button>
                    </td>
                </tr>
<!--            --><?php //} ?>
            </tbody>
        </table>
    </div>
</div>