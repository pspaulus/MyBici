<?php

class Bicicleta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "controlador bicicleta";
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

        //por codigo
//        if ($estacion_id == -1 && $estado_id == -1 && $bicicleta_codigo != -1) {
//            $cogdigo_estacion = substr($bicicleta_codigo, 0, 1);
//            $bicicleta_estacion_id = Estacion::getIdByCodigo($cogdigo_estacion);
//            $bicicleta_codigo = substr($bicicleta_codigo, 1, 4);
//
//            $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id','=',$bicicleta_estacion_id)
//                ->where('codigo', '=', $bicicleta_codigo)
//                ->get();
//        }

        //por estacion y estado
        if ($estacion_id != -1 && $estado_id != -1) {
            $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id','=',$estacion_id)
                ->where('ESTADO_id', '=', $estado_id)
                ->get();
        }

        //por estacion y codigo
//        if ($estacion_id != -1 && $estado_id == -1 && $bicicleta_codigo != -1) {
//            $cogdigo_estacion = substr($bicicleta_codigo, 0, 1);
//            $bicicleta_estacion_id = Estacion::getIdByCodigo($cogdigo_estacion);
//            $bicicleta_codigo = substr($bicicleta_codigo, 1, 4);
//
//            $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id','=',$estacion_id)
//                ->where('codigo', '=', $bicicleta_codigo)
//                ->where('codigo', '=', $bicicleta_estacion_id)
//                ->get();
//        }
        return $bicicletas;
    }

    public function cargarListaBicicletasPorCodigo($bicicleta_codigo)
    {
        if ($bicicleta_codigo == -1) {
            $bicicletas = \App\Bicicleta::all();
        } else {
            $cogdigo_estacion = substr($bicicleta_codigo, 0, 1);
            $bicicleta_estacion_id = Estacion::getIdByCodigo($cogdigo_estacion);
            $bicicleta_codigo = substr($bicicleta_codigo, 1, 4);

            $bicicletas = \App\Bicicleta::where('PUESTO_ALQUILER_id','=',$bicicleta_estacion_id)
                ->where('codigo', '=', $bicicleta_codigo)
                ->get();
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
        return $estacionamientos->codigo;
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

    public function marcarEstado($estado){
        $id = $_REQUEST['id'];

        switch ($estado){
            case 'danada': //da�ada
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

}