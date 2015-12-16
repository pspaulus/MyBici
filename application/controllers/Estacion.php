<?php

class Estacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
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
        //dd($estacion->id+1);
        return $estacion->id + 1;
    }

    public function cargarEstaciones()
    {
        $estaciones = \App\Estacion::all();
        //dd($estaciones);
        return $estaciones;
    }

    //todo-ps debe ir en controller estacionamiento

    public function cargarEstacionamientos($estacion_id, $estado = 'todos')
    {
        switch ($estado) {
            case 'libres':
                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
                    ->where('ESTADO_id', '=', '4')
                    ->get();
                break;
            case 'ocupados':
                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
                    ->where('ESTADO_id', '=', '5')
                    ->get();
                break;
            case 'todos':
                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
                    ->get();
                break;
        }

        //dd($estacionamientos);
        return $estacionamientos;
    }

    public function crearEstacionamiento($estacion_id, $cantidad)
    {
        for ($i = 1; $i <= $cantidad; $i++) {
            $estacion_codigo = $this->getCodigoEstacion($estacion_id);
            $estacionamiento_secuencia = $this->getSecuenciaEstacionamiento($estacion_id);

            $nuevo_codigo = $estacion_codigo . 'P' . $estacionamiento_secuencia;

            //dd($nuevo_codigo);

            //echo $i.' - >'.$nuevo_codigo.'<br>';

            $crear = \App\Estacionamiento::Create([
                'codigo' => $nuevo_codigo,
                'PUESTO_ALQIULER_id' => $estacion_id,
                'BICICLETA_id' => 1,
                'ESTADO_id' => 4
            ]);
        }
    }

    public function cargarUltimoIdEstacionamiento()
    {
        $estacionamiento = \App\Estacionamiento::all()->last();
        //dd($estacionamiento->codigo);
        return $estacionamiento->id + 1;
    }

    public function getCodigoEstacion($id)
    {
        $estacion = \App\Estacion::find($id);
        //dd($estacion->codigo);
        return $estacion->codigo;
    }

    public function getSecuenciaEstacionamiento($estacion_id)
    {
        $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->get()
            ->last();
        $siguiente = substr($estacionamientos->codigo, -3) + 1;
        $siguiente = ($siguiente < 99) ? '0' . $siguiente : $siguiente;
        //dd($siguiente);
        return $siguiente;
    }

    public function cargarVistaParqueos($estacion_id, $estado)
    {
        $data['estacion_id'] = $estacion_id;

        //$Estacion = new Estacion();
        $data['Estacion'] = $this;
        $data['estado'] = $estado;

        $this->load->view('estacion/parqueos',$data);
    }

}