<?php

class Usuario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('usuario/usuario');
    }

    public function consultarUsuario($nombre, $contrasena)
    {
        $usuario = \App\Usuario::where("nombre", "LIKE", $nombre)
            ->where("contrasena", "=", $contrasena)
            ->first();
        return $usuario;
    }

    public function cargarUsuariosTodos($inactivos = false)
    {
        $usuarios = \App\Usuario::where('ESTADO_id', '!=', 0)->get();

        if ($inactivos)
            $usuarios = \App\Usuario::all();

        return $usuarios;
    }

    public function ingresarUsuario()
    {
        $nombre = $_REQUEST['nombre'];
        $contrasena = $_REQUEST['contrasena'];
        $tipo = $_REQUEST['tipo'];

        \App\Usuario::firstOrCreate([
            'nombre' => $nombre,
            'contrasena' => $contrasena,
            'TIPO_id' => $tipo,
            'ESTADO_id' => 1
        ]);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,

        ]);
    }

    public function cargarUltimoId()
    {
        $usuario = \App\Usuario::all()->last();
        return $usuario->id + 1;
    }

    public function eliminarUsuario()
    {
        $id = $_REQUEST['id'];
        $usuario = \App\Usuario::find($id);
        $usuario->ESTADO_id = 2;
        $usuario->save();
    }

    public function editarUsuario()
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $contrasena = $_REQUEST['contrasena'];
        $tipo = $_REQUEST['tipo'];
        $estado = $_REQUEST['estado'];

        $usuario = \App\Usuario::find($id);
        $usuario->nombre = $nombre;
        $usuario->contrasena = $contrasena;
        $usuario->TIPO_id = $tipo;
        $usuario->ESTADO_id = $estado;
        $usuario->save();
    }

    public static function getUsuarioIdByNombre($usuario_nombre)
    {
        $usuario = \App\Usuario::where('nombre', '=', $usuario_nombre)
            ->where('ESTADO_id', '=', 1)
            ->get()
            ->first();

        if ($usuario != null) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'usuario_id' => $usuario->id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public static function getUsuarioIdByNombreDevolver($usuario_nombre)
    {
        $usuario = \App\Usuario::where('nombre', '=', $usuario_nombre)
            ->where('ESTADO_id', '=', 1)
            ->get()
            ->first();

        return ($usuario != null) ? $usuario->id : false;
    }

    public static function getUsuarioNombreById($usuario_id)
    {
        $usuario = \App\Usuario::find($usuario_id);

        return $usuario->nombre;
    }

    public function testMD5()
    {
        dd(md5('mendoza2015'));
    }
}