<?php
//sesiones
session_start();

class Escritorio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['helpers']['escritorio'] = base_url() . 'js/helpers/escritorio.js';
        $data['helpers']['usuario'] = base_url() . 'js/helpers/usuario.js';
        $data['helpers']['login'] = base_url() . 'js/helpers/login.js';
        $data['helpers']['estacion'] = base_url() . 'js/helpers/estacion.js';
        $data['helpers']['inventario'] = base_url() . 'js/helpers/inventario.js';
        $data['helpers']['bicicleta'] = base_url() . 'js/helpers/bicicleta.js';
        $data['helpers']['estacionamiento'] = base_url() . 'js/helpers/estacionamiento.js';
        $data['helpers']['ticket'] = base_url() . 'js/helpers/ticket.js';

        if (isset($_SESSION["Usuario"])) {
            $data['usuario'] = $_SESSION["Usuario"];

            $this->load->view('header');
            $this->load->view('escritorio', $data);
            $this->load->view('footer');
        } else {
            $Login = new Login();
            $Login->index();
        }
    }

    public function salir()
    {
        if (isset($_SESSION["Usuario"])) {
            session_destroy();
        }

        $Login = new Login();
        $Login->index();
    }

}
