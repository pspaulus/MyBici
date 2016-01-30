<?php

class Estado extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('estado');
    }

    public function getEstadoBicicletas()
    {
        $estados = \App\Estado::whereIn('id', [3, 7, 8, 9, 6])
            ->get();
        return $estados;
    }

    public static function getEstadoEstacionamiento()
    {
        $estados = \App\Estado::where('objeto', '=', 'estacionamiento')
            ->get();
        return $estados;
    }

    public function getEstadoTickets()
    {
        $estados = \App\Estado::where('objeto', '=', 'ticket')
            ->get();
        return $estados;
    }

    public static function getEstadoNombreById($estado_id)
    {
        $estado = \App\Estado::find($estado_id);

        return $estado->descripcion;
    }

    public static function getEstadoUsuario()
    {
        $estados = \App\Estado::where('objeto', '=', 'usuario')
            ->get();
        return ($estados)?:null;
    }
}