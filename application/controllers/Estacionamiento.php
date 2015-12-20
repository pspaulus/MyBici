<?php

class Estacionamiento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'Controller Estacionamiento';
    }

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

        return $estacionamientos;
    }

    public function crearEstacionamiento($estacion_id)
    {

        $estacionamiento_secuencia = $this->getSecuenciaEstacionamiento($estacion_id);

        if ($estacion = \App\Estacion::find($estacion_id) != null) {
            $estacion_nueva = \App\Estacionamiento::firstOrCreate([
                'codigo' => $estacionamiento_secuencia,
                'PUESTO_ALQUILER_id' => $estacion_id,
                'BICICLETA_id' => null,
                'ESTADO_id' => 4 //libre
            ]);

            if ($estacion_nueva->id != null) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => true,
                    'estacionamiento_nuevo_id' => $estacion_nueva->id
                ]);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function cargarUltimoIdEstacionamiento()
    {
        $estacionamiento = \App\Estacionamiento::all()->last();
        return $estacionamiento->id + 1;
    }

    public function getCodigoEstacion($id)
    {
        $estacion = \App\Estacion::find($id);
        return $estacion->codigo;
    }

    public function getSecuenciaEstacionamiento($estacion_id)
    {
        $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->orderBy('codigo', 'ASC')
            ->get()
            ->last();

        $estacionamientos_secuencia = ($estacionamientos == null) ? 1 : $estacionamientos->codigo + 1;
        return $estacionamientos_secuencia;
    }

    public function cargarVistaParqueos($estacion_id, $estado)
    {
        $data['estacion_id'] = $estacion_id;

        //$Estacion = new Estacion();
        $data['Estacion'] = $this;
        $data['estado'] = $estado;

        $this->load->view('estacion/parqueos', $data);
    }

    public static function contarNumeroEstacionamiento($estacion_id)
    {
        return $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->get()
            ->count();
    }




}
