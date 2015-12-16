<?php

class Estacionamiento extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {

    }

    public function crearEstacionamiento($puesto_alquiler, $cantidad)
    {
        for ($i = 0; $i <= $cantidad; $i++) {
            echo $i,$puesto_alquiler,$cantidad;
            \App\Estacionamiento::Create([
                'BICICLETA_id' => null,
                'PUESTO_ALQUILER_id' => $puesto_alquiler,
                'ESTADO_id' => 4
            ]);
        }
}
}
