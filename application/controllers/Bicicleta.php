<?php

class Bicicleta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "Controlador bicicleta";
    }

    public function cargarBicicleta($id)
    {
        $bicicleta = \App\Bicicleta::find($id);
        return $bicicleta;
    }

    public function contarBicicletas()
    {
        $conteo_bicicletas = \App\Bicicleta::all()
            ->count();
        return $conteo_bicicletas;
    }

    public function contarBicicletasEstado($estado)
    {
        switch ($estado) {
            case 'buena':
                $estado = 7;
                break;
            case 'reparar':
                $estado = 3;
                break;
            case 'en_uso':
                $estado = 9;
                break;
            case 'danada':
                $estado = 8;
                break;
        }
        $conteo_bicicletas = \App\Bicicleta::where('ESTADO_id', '=', $estado)
            ->count();
        return $conteo_bicicletas;
    }

    public function cargarListaBicicletasporEstacion($estacion_id, $estado_id)
    {
        //todas
        if ($estacion_id == -1 && $estado_id == -1) {
            $bicicletas = \App\Bicicleta::all();
        }

        //por estacion
        if ($estacion_id != -1 && $estado_id == -1) {
            $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id', '=', $estacion_id)
                ->get();
        }

        //por estado
        if ($estacion_id == -1 && $estado_id != -1) {
            $bicicletas = \App\Bicicleta::where('ESTADO_id', '=', $estado_id)
                ->get();
        }

        //por estacion y estado
        if ($estacion_id != -1 && $estado_id != -1) {
            $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id', '=', $estacion_id)
                ->where('ESTADO_id', '=', $estado_id)
                ->get();
        }

        return $bicicletas;
    }

    public function cargarListaBicicletasPorCodigo($bicicleta_codigo)
    {
        if ($bicicleta_codigo == -1) {
            $bicicletas = \App\Bicicleta::all();
        } else {
            $bicicleta_estacion_id = Estacion::getIdByCodigo($bicicleta_codigo[0]);

            if (empty($bicicleta_estacion_id)) {
                return null;
            } else {
                $bicicleta_codigo = substr($bicicleta_codigo, 2, strlen($bicicleta_codigo));

                $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id', '=', $bicicleta_estacion_id)
                    ->where('codigo', '=', $bicicleta_codigo)
                    ->get();
            }
        }

        return $bicicletas;
    }

    public static function getEstadoBicicleta($id)
    {
        $bicicleta = \App\Bicicleta::find($id);
        $estado = \App\Estado::find($bicicleta->ESTADO_id);
        return $estado->descripcion;
    }

    public static function getEstacionamiento($id)
    {
        $estacionamientos = \App\Estacionamiento::where('BICICLETA_id', '=', $id)
            ->get()
            ->first();

        return (!$estacionamientos == null) ? $estacionamientos->codigo : null;
    }

    public function cargarVistaListadoBicicletasPorEstacion($estacion_id, $estado_id)
    {
        $data['estacion_id'] = $estacion_id;
        $data['estado_id'] = $estado_id;
        $data['filtro'] = 'estacion';

        $this->load->view('inventario/listado', $data);
    }

    public function cargarVistaListadoBicicletasPorCodigo($bicicleta_codigo = -1)
    {
        $data['bicicleta_codigo'] = $bicicleta_codigo;
        $data['filtro'] = 'codigo';

        $this->load->view('inventario/listado', $data);
    }

    public function marcarEstado($estado)
    {
        $id = $_REQUEST['id'];

        switch ($estado) {
            case 'danada': //dañada
                $estado = 8;
                break;

            case 'reparar': //reparar
                $estado = 3;
                break;

            case 'buena': //buena
                $estado = 7;
                break;

            case 'en_uso': //en_uso
                $estado = 9;
                break;
        }

        $bicicleta = \App\Bicicleta::find($id);
        $bicicleta->ESTADO_id = $estado;
        $bicicleta->save();

        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
        ]);
    }

    public function cargarUltimoId()
    {
        $bicicleta = \App\Bicicleta::all()->last();
        return $bicicleta->id + 1;
    }

    public function getSecuenciaCodigo($bicicleta_estacion_id)
    {
        $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id', '=', $bicicleta_estacion_id)
            ->get();

        $bicicleta_secuencia = ($bicicletas == null) ? 1 : count($bicicletas) + 1;
        echo $bicicleta_secuencia;
    }

    public function guardarBicicleta()
    {
        $codigo = $_REQUEST['codigo'];
        $PUESTO_ALQUILER_id = $_REQUEST['PUESTO_ALQUILER_id'];
        $TIPO_id = $_REQUEST['TIPO_id'];
        $ESTADO_id = $_REQUEST['ESTADO_id'];

        $secuencia = substr($codigo, 2);

        $bicicleta = \App\Bicicleta::where('codigo', '=', $secuencia)
            ->where('PUESTO_ALQUILER_id', '=', $PUESTO_ALQUILER_id)
            ->get();

        if ($bicicleta->first() == null) {

            \App\Bicicleta::firstOrCreate([
                'codigo' => $secuencia,
                'PUESTO_ALQUILER_id' => $PUESTO_ALQUILER_id,
                'TIPO_id' => $TIPO_id,
                'ESTADO_id' => $ESTADO_id
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

    public static function getTipo($tipo_id)
    {
        $tipo_descripcion = \App\Tipo::find($tipo_id);
        return $tipo_descripcion->descripcion;
    }

    public function getIdBicicletaByCodigo($bicicleta_codigo)
    {
        $estacion_codigo = substr($bicicleta_codigo, 0, 1);
        $estacion_id = Estacion::getIdByCodigo($estacion_codigo);

        $bicicleta_secuencia = substr($bicicleta_codigo, 2, strlen($bicicleta_codigo));

        $bicicleta = \App\Bicicleta::where('codigo', '=', $bicicleta_secuencia)
            ->where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->get();

        if ($bicicleta != null) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'bicicleta_id' => $bicicleta->id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }

    }

    public static function getCodigoEstacionByBicicletaEstacionId($bicicleta_ESTACION_id)
    {
        $estacion = \App\Estacion::find($bicicleta_ESTACION_id);
        return $estacion->codigo;
    }

    public function verificarBicicletaEstacionada($bicicleta_id)
    {
        $estacionamiento = \App\Estacionamiento::where('BICICLETA_id', '=', $bicicleta_id)
            ->get()
            ->first();

        if ($estacionamiento == null) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true, //no esta estacionada en ningun lado
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
                'estacionamiento_id' => $estacionamiento->id
            ]);
        }
    }

    public static function cargarBicicletaDisponibleMostrar($estacion_id)
    {
        $estacion_codigo = Estacion::getCodigoEstacionByIdRetornar($estacion_id);

        $bicicleta = \App\Bicicleta::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->where('ESTADO_id', '=', 7)
            ->get()
            ->first();

        echo $estacion_codigo . 'B' . $bicicleta->codigo;

    }

    public static function cargarBicicletaDisponible($estacion_id)
    {
        $estacion_codigo = Estacion::getCodigoEstacionByIdRetornar($estacion_id);

        $bicicleta = \App\Bicicleta::where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->where('ESTADO_id', '=', 7)
            ->get()
            ->first();

        if ($bicicleta != null) {
            $codigo_bicicleta = $estacion_codigo . 'B' . $bicicleta->codigo;
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'codigo_bicicleta' => $codigo_bicicleta
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public static function getIdBicicletaByCodigoDevolver($bicicleta_codigo)
    {
        $estacion_codigo = substr($bicicleta_codigo, 0, 1);
        $estacion_id = Estacion::getIdByCodigo($estacion_codigo);

        $bicicleta_secuencia = substr($bicicleta_codigo, 2, strlen($bicicleta_codigo));

        $bicicleta = \App\Bicicleta::where('codigo', '=', $bicicleta_secuencia)
            ->where('PUESTO_ALQUILER_id', '=', $estacion_id)
            ->get()
            ->first();

        if ($bicicleta != null) {
                return $bicicleta->id;
        } else {
            return false;
        }
    }

    public static function getBicicletaCodigoById($bicicleta_id)
    {
        $bicicleta = \App\Bicicleta::find($bicicleta_id);
        $estacion_codigo = Estacion::getCodigoEstacionByIdRetornar($bicicleta->PUESTO_ALQUILER_id);

        echo $estacion_codigo . 'B' . $bicicleta->codigo;
    }
}