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
        $data['helpers']['evento'] = base_url() . 'js/helpers/evento.js';
        $data['helpers']['map'] = base_url() . 'js/helpers/map.js';

        if (isset($_SESSION["Usuario"])) {
            $data['usuario'] = $_SESSION["Usuario"];

            $this->load->view('header', $data);
            $this->load->view('escritorio');
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

    public static function getHoraEcuador()
    {
        return date('H:i:s', time() - ((60 * 60) * 5));
    }

    public static function getFechaEcuador()
    {
        return date('Y-m-d', time() - ((60 * 60) * 5));
    }


    public static function verificarInternet()
    {
        $connected = @fsockopen("www.google.com", 80);
        //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }

    public static function mostrarMensaje($mensaje_tipo)
    {
        switch ($mensaje_tipo){

            case 'sin_conexion_internet':
                $archivo = 'sin_conexion_internet';
                break;

            case 'no_muestra_contenido':
                $archivo = 'no_muestra_contenido';
                break;
        }
        $Escritorio = new Escritorio();
        $Escritorio->load->view('mensaje/'.$archivo);
    }

}
