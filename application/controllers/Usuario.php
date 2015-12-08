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

        dd( md5('123123123'));

        $usuario = \App\Usuario::where("nombre", "LIKE", $nombre)
            ->where("contrasena", "=", $contrasena)
            ->first();
        dd($usuario);
        return $usuario;
    }
}