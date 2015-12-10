<?php

class Usuario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'Controlador Usuario';
    }

    public function consultarUsuario($nombre, $contrasena)
    {



        $usuario = \App\Usuario::where("nombre", "LIKE", $nombre)
            ->where("contrasena", "=", $contrasena)
            ->first();
        dd($usuario);
        return $usuario;
    }

    public function testMD5(){
        //dd( md5('123123123'));
    }
}