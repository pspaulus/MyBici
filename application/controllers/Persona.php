<?php

class Persona extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('persona');
    }

    public function cargarUsuariosTodos($inactivos = false)
    {
        $usuarios = \App\Usuario::where('ESTADO_id', '!=', 0)->get();

        if ($inactivos)
            $usuarios = \App\Usuario::all();

        //dd($collection_usuarios);
        return $usuarios;
    }

    public function ingresarUsuario()
    {
        $nombre = $_REQUEST['nombre'];
        $contrasena = $_REQUEST['contrasena'];

        $user = \App\Usuario::firstOrCreate([
            'nombre' => $nombre,
            'contrasena' => $contrasena,
            'ESTADO_id' => 1
        ]);

        //dd($user);
    }

    public function cargarUltimoId()
    {
        $usuario = \App\Usuario::all()->last();
        return $usuario->id+1;
    }

    public function eliminarUsuario(){
        $id = $_REQUEST['id'];
        $usuario = \App\Usuario::find($id);
        $usuario->ESTADO_id = 2;
        $usuario->save();
    }

    public function editarUsuario(){
//        $user = User::find(1);
//        $user->email = 'john@foo.com';
//        $user->save();
    }
}