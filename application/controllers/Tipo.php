<?php

class Tipo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'Controller Tipo';
    }

    public function getTipoBicicletas()
    {
        $bicicleta_tipo = \App\Tipo::whereIn('id',[5,6])
            ->get();
        return $bicicleta_tipo;
    }

    public static function getReservaTipoById($tipo_id)
    {
        $tipo = \App\Tipo::find($tipo_id);

        return $tipo->descripcion;
    }

    public static function getTiposUsuario()
    {
        $tipos = \App\Tipo::where('objeto', '=', 'usuario')
            ->get();
        return ($tipos)?:null;
    }
}