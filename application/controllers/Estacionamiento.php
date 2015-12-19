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

        //dd($estacionamientos);
        return $estacionamientos;
    }

    public function crearEstacionamiento($estacion_id)
    {

        $estacion_codigo = $this->getCodigoEstacion($estacion_id);
        $estacionamiento_secuencia = $this->getSecuenciaEstacionamiento($estacion_id);

        $nuevo_codigo = $estacion_codigo . 'P' . $estacionamiento_secuencia;

        //dd($nuevo_codigo);

        //echo $i.' - >'.$nuevo_codigo.'<br>';

        \App\Estacionamiento::Create([
            'codigo' => $nuevo_codigo,
            'PUESTO_ALQIULER_id' => $estacion_id,
            'BICICLETA_id' => 1,
            'ESTADO_id' => 4
        ]);

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

        $this->load->view('estacion/parqueos', $data);
    }
//    public function __construct()
//    {
//        parent::__construct();
//        $this->load->helper('url');
//    }
//
//    public function index()
//    {
//        //echo 'estacionamientos';
//    }

//    public function cargarEstacionamientos($puesto_alquiler, $estado = 'todos')
//    {
//        switch ($estado) {
//            case 'libres':
//                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $puesto_alquiler)
//                    ->where('ESTADO_id', '=', '4')
//                    ->get();
//                break;
//            case 'ocupados':
//                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $puesto_alquiler)
//                    ->where('ESTADO_id', '=', '5')
//                    ->get();
//                break;
//            case 'todos':
//                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $puesto_alquiler)
//                    ->get();
//                break;
//        }
//
//        //dd($estacionamientos);
//        return $estacionamientos;
//    }
//
//    public function crearEstacionamiento($puesto_alquiler, $cantidad)
//    {
//        for ($i = 1; $i <= $cantidad; $i++) {
//            $estacion_codigo = $this->getCodigoEstacion($puesto_alquiler);
//            $estacionamiento_secuencia = $this->getSecuenciaEstacionamiento($puesto_alquiler);
//
//            $nuevo_codigo = $estacion_codigo . 'P' . $estacionamiento_secuencia;
//
//            //dd($nuevo_codigo);
//
//            //echo $i.' - >'.$nuevo_codigo.'<br>';
//
//            $crear = \App\Estacionamiento::Create([
//                'codigo' => $nuevo_codigo,
//                'PUESTO_ALQIULER_id' => $puesto_alquiler,
//                'BICICLETA_id' => 1,
//                'ESTADO_id' => 4
//            ]);
//        }
//    }
//
//    public function cargarUltimoIdEstacionamiento()
//    {
//        $estacionamiento = \App\Estacionamiento::all()->last();
//        //dd($estacionamiento->codigo);
//        return $estacionamiento->id + 1;
//    }
//
//    public function getCodigoEstacion($id)
//    {
//        $estacion = \App\Estacion::find($id);
//        //dd($estacion->codigo);
//        return $estacion->codigo;
//    }
//
//    public function getSecuenciaEstacionamiento($puesto_alquiler)
//    {
//        $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $puesto_alquiler)
//            ->get()
//            ->last();
//        $siguiente = substr($estacionamientos->codigo, -3) + 1;
//        $siguiente = ($siguiente < 99) ? '0' . $siguiente : $siguiente;
//        //dd($siguiente);
//        return $siguiente;
//    }


}
