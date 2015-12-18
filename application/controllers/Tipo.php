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
}