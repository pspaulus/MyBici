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

    public static function contarEstacionamientoDisponiblesByEstacion($estacion_id)
    {
        $estacionamientos_disponibles = \App\Estacionamiento::where('ESTADO_id', '=', 7)
            ->where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->count();
        return $estacionamientos_disponibles;
    }

    public static function contarEstacionamientoTodosByEstacion($estacion_id)
    {
        $estacionamientos_total = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->count();
        return $estacionamientos_total;
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

    public function crearEstacionamiento($estacion_id, $cantidad)
    {
        for ($i = 0; $i < $cantidad; $i++) {

            $estacionamiento_secuencia = $this->getSecuenciaEstacionamiento($estacion_id);

            $estacion_nueva = \App\Estacionamiento::firstOrCreate([
                'codigo' => $estacionamiento_secuencia,
                'PUESTO_ALQUILER_id' => $estacion_id,
                'BICICLETA_id' => null,
                'ESTADO_id' => 4 //libre
            ]);

            echo 'E->' . $estacion_nueva->PUESTO_ALQUILER_id . ' P->' . $estacion_nueva->codigo . ' || ';
        }
    }

    public function cargarUltimoIdEstacionamiento()
    {
        $estacionamiento = \App\Estacionamiento::all()->last();
        return $estacionamiento->id + 1;
    }

    public static function getCodigoEstacion($id)
    {
        $estacion = \App\Estacion::find($id);
        return $estacion->codigo;
    }

    public function getSecuenciaEstacionamiento($estacion_id)
    {
        $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->get();

        $estacionamientos_secuencia = ($estacionamientos == null) ? 1 : count($estacionamientos) + 1;
        return $estacionamientos_secuencia;
    }

    public function cargarVistaParqueos($estacion_id, $estado)
    {
        $data['estacion_id'] = $estacion_id;
        $data['Estacion'] = $this;
        $data['estado'] = $estado;

        $this->load->view('estacionamiento/listado', $data);
    }

    public static function contarNumeroEstacionamiento($estacion_id)
    {
        return $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->get()
            ->count();
    }

    public function quitarBicicleta($estacionamiento_id)
    {
        $estacionamiento = \App\Estacionamiento::find($estacionamiento_id);

        $estacionamiento->BICICLETA_id = null;
        $estacionamiento->ESTADO_id = 4;
        if ($estacionamiento->save()) {
            echo 'OK: eliminar bicicleta en E->' . $estacionamiento->id;
        } else {
            echo 'ERROR: eliminar bicicleta en E->' . $estacionamiento->id;
        }
    }

    public function agregarBicicleta($estacionamiento_id, $bicicleta_id)
    {
        $estacionamiento = \App\Estacionamiento::find($estacionamiento_id);

        $estacionamiento->BICICLETA_id = $bicicleta_id;
        $estacionamiento->ESTADO_id = 5;
        if ($estacionamiento->save()) {
            echo 'OK: agregar bicicleta en E->' . $estacionamiento->id . ' B->' . $bicicleta_id;
        } else {
            echo 'ERROR: agregar bicicleta en E->' . $estacionamiento->id . ' B->' . $bicicleta_id;
        }
    }

    public static function cargarEstacionamientosDisponible($estacion_id)
    {

        $estacionamiento = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->where('ESTADO_id', '=', '4')
            ->get()
            ->first();

        return ($estacionamiento != null) ? $estacionamiento->id : null;
    }

    public static function getEstacionamiento($bicicleta_id)
    {
        $estacionamiento = \App\Estacionamiento::where('BICICLETA_id', '=', $bicicleta_id)
            ->get()
            ->first();
        return ($estacionamiento != null) ? $estacionamiento->id : null;
    }

    public static function getEstacionamientoOrigenDestino($estacionmiento_id)
    {
        $estacimonamiento = \App\Estacionamiento::find($estacionmiento_id);

        if ($estacimonamiento != null) {
            $estacion_codigo = Estacion::getCodigoEstacionByIdDevolver($estacimonamiento->PUESTO_ALQUILER_id);

            return $estacion_codigo . 'P' . $estacimonamiento->codigo;
        } else {
            return '<i class="fa fa-clock-o"></i> ';
        }
    }

    public static function validarEstacionamientoDisponible($estacion_id)
    {
        $estacionamiento = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->where('ESTADO_id', '=', 4)//libre
            ->get()
            ->first();

        if ($estacionamiento != null) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'estacionamiento_id' => $estacionamiento->id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }
}
