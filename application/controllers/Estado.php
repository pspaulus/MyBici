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
        $estados = \App\Estado::whereIn('id', [3, 7, 8, 9])
            ->get();
        return $estados;
    }

    public function getEstadoTickets()
    {
        $estados = \App\Estado::where('objeto', '=', 'ticket')
            ->get();
        return $estados;
    }
}