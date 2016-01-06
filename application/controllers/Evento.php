<?php

class Evento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('evento/evento');
    }

    public function cargarTodos()
    {
        $eventos = \App\Evento::all();
        return ($eventos != null) ? $eventos : null;
    }

    public function cargar($evento_id)
    {
        $evento = \App\Evento::find($evento_id);
        return ($evento != null) ? $evento : null;
    }

    public function guardar()
    {
        $tipo =  $_REQUEST['tipo'];
        $nombre = $_REQUEST['nombre'];
        $descripcion = ($_REQUEST['descripcion']) ?: null;
        $fecha = Escritorio::getFechaEcuador();
        $estado = 15; //En construccion
        $evento_nuevo = \App\Evento::firstOrCreate([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'fecha' => $fecha,
            'cantidad_participantes' => $_REQUEST['cantidad'],
            'TIPO_id' => $tipo,
            'ESTADO_id' => $estado
        ]);

        if ($evento_nuevo != null) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'evento_nuevo_id' => $evento_nuevo->id,
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false
            ]);
        }
    }

    public static function cargarTipos()
    {
        $tipos = \App\Tipo::where('objeto', '=', 'evento')
            ->get();

        return ($tipos != null) ? $tipos : null;
    }

    public static function cargarEstados()
    {
        $estados = \App\Estado::where('objeto', '=', 'evento')
            ->get();

        return ($estados != null) ? $estados : null;
    }

}