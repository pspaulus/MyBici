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

    public static function cargarBicicleta($id)
    {
        $bicicleta = \App\Bicicleta::find($id);
        //dd($bicicleta);
        return $bicicleta;
    }
}