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
        //dd($bicicleta);
        return $bicicleta;
    }

    public function contarBicicletas()
    {
        $conteo_bicicletas = \App\Bicicleta::all()
            ->count();
        //dd($conteo_bicicletas);
        return $conteo_bicicletas;
    }

    public function contarBicicletasEstado($estado)
    {
        switch ($estado) {
            case 'disponibles':
                $estado = 7;
                break;
            case 'mantenimiento':
                $estado = 8;
                break;
            case 'en_uso':
                $estado = 9;
                break;
        }
        $conteo_bicicletas = \App\Bicicleta::where('ESTADO_id', '=', $estado)
            ->count();
        //dd($conteo_bicicletas);
        return $conteo_bicicletas;
    }
}