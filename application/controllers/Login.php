<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
//        $this->load->helper('login');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['helpers'] = base_url() . 'js/helpers/login.js';

        $this->load->view('header');
        $this->load->view('login', $data);
        $this->load->view('footer');
    }

    public function validarUSuario()
    {
        $nombre = $_POST['usuario'];
        $contrasena = $_POST['$contrasena'];
        echo 'php usuario ->' . $nombre . '<br>';
        echo 'php contrasena ->' . $contrasena;

    }
}
