<?php

class Inventario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('inventario/inventario');
    }
}