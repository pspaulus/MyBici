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
            $usuario = \App\Usuario::where('nombre', '=', $_SESSION["Usuario"])->get()->first();
            $data['usuario_nombre'] = $_SESSION["Usuario"];
            $data['tdu'] = $usuario->TIPO_id;

            $_SESSION["usuario_tipo"] = ($usuario != null) ? $usuario->TIPO_id : 3;

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
        //return date('H:i:s', time() - ((60 * 60) * 5));
        return date('H:i:s', time());
    }

    public static function getFechaEcuador()
    {
        //return date('Y-m-d', time() - ((60 * 60) * 5));
        return date('Y-m-d', time());
    }

    public static function getFechaHoraEcuador()
    {
        //return date('Y-m-d H:i:s', time() - ((60 * 60) * 5));
        return date('Y-m-d H:i:s', time() );
    }

    public static function varificarAdmin(){

    }

    public static function verificarInternet()
    {
        $connected = @fsockopen("www.google.com", 80);
        //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = true; //action when connected
            fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
        //return false;
    }

    public static function Mensaje($mensaje_tipo, $entidad = null)
    {
        switch ($mensaje_tipo) {

            case 'sin_conexion_internet':
                $archivo = 'sin_conexion_internet';
                break;

            case 'no_muestra_contenido':
                $archivo = 'no_muestra_contenido';
                break;

            case 'guardar_ok':
                $archivo = 'guardar_ok';
                break;

            case 'editar_ok':
                $archivo = 'editar_ok';
                break;

            case 'restaurar_ok':
                $archivo = 'restaurar_ok';
                break;

            case 'eliminar_ok':
                $archivo = 'eliminar_ok';
                break;

            case 'error':
                $archivo = 'error';
                break;
        }

        $data['entidad'] = $entidad;

        if (!empty($archivo)) {
            $Escritorio = new Escritorio();
            $Escritorio->load->view('mensaje/' . $archivo, $data);
        }
    }
}
