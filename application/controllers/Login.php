<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['helpers'] = base_url() . 'js/helpers/login.js';

        $this->load->view('header');
        $this->load->view('login', $data);
        $this->load->view('footer');
    }

    public function validarUsuario()
    {
        $nombre = $_POST['usuario'];
        //$contrasena = md5( $_POST['contrasena'] );
        $contrasena =  $_POST['contrasena'] ;

//        $usuario = \App\Usuario::where("nombre", "LIKE", $nombre)
//            ->where("contrasena", "=", md5($contrasena))
//            ->first();

        //dd($usuario);
        $usuario = true;
         session_start();

        if ((bool) $usuario) {

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
