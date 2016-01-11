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

    public static function contarBicicletasDisponiblesByEstacion($estacion_id)
    {
        $bicicletas_disponibles = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->whereNotNull('BICICLETA_id')
            ->count();
        return $bicicletas_disponibles;
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

    public function cargarEstacionamientos($estacion_id, $estado_id)
    {
        if ($estacion_id == -1 && $estado_id == -1){
            $estacionamientos = \App\Estacionamiento::all();
        } else {
            if ($estacion_id == -1 && $estado_id == -1){
                $estacionamientos = \App\Estacionamiento::where('ESTADO_id', '=', $estado_id)
                    ->get();
            } elseif ( $estacion_id != -1 && $estado_id == -1 ) {
                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
                    ->get();
            } elseif ( $estacion_id != -1 && $estado_id != -1){
                $estacionamientos = \App\Estacionamiento::where('PUESTO_ALQUILER_id', '=', $estacion_id)
                    ->where('ESTADO_id', '=', $estado_id)
                    ->get();
            }
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

    public function cargarVistaListadoEstacionamientos($estacion_id, $estado)
    {
        $data['estacion_id'] = $estacion_id;
        $data['estado'] = $estado;
        $data['Estacionamiento'] = $this;
        $data['Bicicleta'] = new Bicicleta();
        $data['Estacion'] = new Estacion();


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
        $resultado = $estacionamiento->save();

        $mensaje =  ($resultado)?
            'OK: eliminar bicicleta en E->' . $estacionamiento->id :
            'ERROR: eliminar bicicleta en E->' . $estacionamiento->id;

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado,
            'mensaje' => $mensaje
        ]);
    }

    public function agregarBicicleta($estacionamiento_id, $bicicleta_id)
    {
        $estacionamiento = \App\Estacionamiento::find($estacionamiento_id);

        $estacionamiento->BICICLETA_id = $bicicleta_id;
        $estacionamiento->ESTADO_id = 5;
        $resultado = $estacionamiento->save();

        $mensaje =  ($resultado)?
            'OK: agregar bicicleta en E->' . $estacionamiento->id . ' B->' . $bicicleta_id :
            'ERROR: agregar bicicleta en E->' . $estacionamiento->id . ' B->' . $bicicleta_id;

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado,
            'mensaje' => $mensaje
        ]);
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

    public function cargarVistaBusquedaEstacionamiento()
    {
        $data['Estacion'] = new Estacion();
        $data['Estacionamiento'] = $this;
        $this->load->view('estacionamiento/estacionamiento', $data);
    }

    public static function generarCodigo($estacionamiento_id){
        $estacionamiento = \App\Estacionamiento::find($estacionamiento_id);

        if ($estacionamiento != null){

            $estacion_codigo = Estacion::getCodigoEstacionByIdDevolver($estacionamiento->PUESTO_ALQUILER_id);
            $secuecia= $estacionamiento->codigo;

            return $estacionamiento_codigo = $estacion_codigo.'P'.$secuecia ;
        } else {
            return null;
        }
    }
}
