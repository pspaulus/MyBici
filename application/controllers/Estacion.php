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
        $longitud = $_REQUEST['longitud'];
        $latitud = $_REQUEST['latitud'];

        $estaciones = \App\Estacion::where('nombre', '=', $nombre)
            ->orwhere('codigo', '=', $codigo)
            ->get();

        if ($estaciones->first() == null) {
            $nueva_estacion = \App\Estacion::firstOrCreate([
                'nombre' => $nombre,
                'codigo' => $codigo,
                'longitud' => $longitud,
                'latitud' => $latitud
            ]);

            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'estacion_nueva_id' => $nueva_estacion->id
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
        echo ($estacion != null) ? $estacion->codigo : null;
    }

    public static function cargarEstacion($id)
    {
        return $estacion = \App\Estacion::find($id);
    }

    public function cargarDatosEstacion($id){
        $data['estacion_actual'] = $this->cargarEstacion($id);
        $data['Estacion'] = $this;

        $this->load->view('estacion/datos',$data);
    }

    public function editarEstacion()
    {
        $estacion_id = $_REQUEST['id'];
        $codigo = $_REQUEST['codigo'];
        $nombre = $_REQUEST['nombre'];

        $estacion = \App\Estacion::find($estacion_id);
        $estacion->codigo = $codigo;
        $estacion->nombre = $nombre;


        $estacion->save();
        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
        ]);
    }

    public static function getCodigoEstacionByIdRetornar($id)
    {
        $estacion = \App\Estacion::find($id);
        return ($estacion != null) ? $estacion->codigo : null;
    }

    public static function getEstacionNombreById($estacion_id)
    {
        $estacion = \App\Estacion::find($estacion_id);
        return $estacion->nombre;
    }
}