<?php

class Estado extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('estado');
    }

    public function getEstadoBicicletas()
    {
        $estados = \App\Estado::whereIn('id',[6,7,8])
            ->get();
        return $estados;
    }
}