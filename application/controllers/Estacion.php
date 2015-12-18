<?php

class Estacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('estacion/ver');
    }

    public function crearEstacion()
    {
        $nombre = $_REQUEST['nombre'];
        $codigo = $_REQUEST['codigo'];
        $coordenada_x = $_REQUEST['coordenada_x'];
        $coordenada_y = $_REQUEST['coordenada_y'];

        $estaciones = \App\Estacion::where('nombre', '=', $nombre)
            ->where('codigo', '=', $codigo)
            ->get();

        if ((bool)$estaciones) {
            \App\Estacion::firstOrCreate([
                'nombre' => $nombre,
                'codigo' => $codigo,
                'coordenada_x' => $coordenada_x,
                'coordenada_y' => $coordenada_y
            ]);

            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function cargarUltimoId()
    {
        $estacion = \App\Estacion::all()->last();
        return $estacion->id + 1;
    }

    public function cargarEstaciones()
    {
        $estaciones = \App\Estacion::all();
        return $estaciones;
    }

    public static function getCodigoEstacion($id)
    {
        $estacion = \App\Estacion::find($id);
        return $estacion->codigo;
    }

    public static function getNombreEstacion($id)
    {
        $estacion = \App\Estacion::find($id);
        return $estacion->nombre;
    }

    public static function getIdByCodigo($codigo)
    {
        $estacion = \App\Estacion::where('codigo', '=', $codigo)
            ->get()
            ->first();
        return ($estacion == null) ? null : $estacion->id;

    }

    public static function getCodigoEstacionById($id)
    {
        $estacion = \App\Estacion::find($id);
        echo $estacion->codigo;
    }
}