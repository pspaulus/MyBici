<?php

class Login extends CI_Controller
{

//    public function __construct()
//    {
//        parent::__construct();
//    }

    public function index()
    {
        $data['helpers']['login'] = base_url() . 'js/helpers/login.js';

        $this->load->view('header');
        $this->load->view('login', $data);
        $this->load->view('footer');
    }

    public function validarUsuario()
    {
        //http://mybici.server/Login/validarUsuario?usuario=admin&contrasena=123123123
        $nombre = $_REQUEST['usuario'];
        //$contrasena = md5( $_POST['contrasena'] );
        $contrasena =  $_REQUEST['contrasena'] ;

        $usuario = \App\Usuario::where("nombre", "LIKE", $nombre)
            ->where("contrasena", "=", md5($contrasena))
            ->first();

        //dd($usuario);
        $usuario = true;


        if ((bool) $usuario) {
            session_start();
            $_SESSION["Usuario"] = $nombre;
            echo $_SESSION["Usuario"];

            //if ( isset($_SESSION["Usuario"]) ) dd("muere");
            $esctritorio = new Escritorio();
            $esctritorio->index();
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'msg' => "Usuario o Clave incorrecta!",
            ]);
        }

    }
}
