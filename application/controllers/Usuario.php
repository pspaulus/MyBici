<?php

class Usuario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['Usuario'] = $this;
        $this->load->view('usuario/usuario', $data);
    }

    public function cargarVistaCrear()
    {
        $data['Usuario'] = $this;
        $data['tdu'] = $_REQUEST["tdu"];
        $this->load->view('usuario/crear', $data);
    }

    public function cagarVistaEditar($tdu)
    {
        $data['Usuario'] = $this;
        $data['tdu'] = $tdu;
        $this->load->view('usuario/editar', $data);
    }

    public function consultarUsuario($nombre, $contrasena)
    {
        $usuario = \App\Usuario::where("nombre", "LIKE", $nombre)
            ->where("contrasena", "=", $contrasena)
            ->first();
        return $usuario;
    }

    public function cargarUsuariosTodos($filtro, $valor_a_buscar, $ver_inactivos, $tdu)
    {
        if($tdu == 1){
            if ($valor_a_buscar == '') {
                if ($ver_inactivos) {
                    $usuarios = \App\Usuario::whereNotIn('id',[1])
                        ->get();
                } else {
                    $usuarios = \App\Usuario::where('ESTADO_id', '=', 1)
                        ->whereNotIn('id',[1])
                        ->get();
                }
            } else {
                if ($filtro == 'id') {
                    if ($ver_inactivos) {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar)
                            ->whereNotIn('id',[1])
                            ->get();
                    } else {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar)
                            ->where('ESTADO_id', '=', 1)
                            ->whereNotIn('id',[1])
                            ->get();
                    }
                } elseif ($filtro == 'nombre') {
                    if ($ver_inactivos) {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar . '%')
                            ->whereNotIn('id',[1])
                            ->get();
                    } else {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar . '%')
                            ->where('ESTADO_id', '=', 1)
                            ->whereNotIn('id',[1])
                            ->get();
                    }
                }
            }
        }else {
            if ($valor_a_buscar == '') {
                if ($ver_inactivos) {
                    $usuarios = \App\Usuario::whereNotIn('TIPO_id',[1,8])
                        ->get();
                } else {
                    $usuarios = \App\Usuario::where('ESTADO_id', '=', 1)
                        ->whereNotIn('TIPO_id',[1,8])
                        ->get();
                }
            } else {
                if ($filtro == 'id') {
                    if ($ver_inactivos) {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar)
                            ->whereNotIn('TIPO_id',[1,8])
                            ->get();
                    } else {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar)
                            ->where('ESTADO_id', '=', 1)
                            ->whereNotIn('TIPO_id',[1,8])
                            ->get();
                    }
                } elseif ($filtro == 'nombre') {
                    if ($ver_inactivos) {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar . '%')
                            ->whereNotIn('TIPO_id',[1,8])
                            ->get();
                    } else {
                        $usuarios = \App\Usuario::where($filtro, 'LIKE', $valor_a_buscar . '%')
                            ->where('ESTADO_id', '=', 1)
                            ->whereNotIn('TIPO_id',[1,8])
                            ->get();
                    }
                }
            }
        }
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
            'status' => true
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

        if( $usuario->save()){
            $resultado = true;
            $mensaje = 'OK: usuario editado';
        } else {
            $resultado = false;
            $mensaje = 'ERROR: No edita usuario';
        }

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado,
            'mensaje' => $mensaje,
            'usuario_id' => $usuario->id
        ]);
    }

    public function editarUsuario()
    {
        $id = $_REQUEST['id'];
        $contrasena = $_REQUEST['contrasena'];
        $tipo = $_REQUEST['tipo'];
        $estado = $_REQUEST['estado'];

        $usuario = \App\Usuario::find($id);
        $usuario->contrasena = $contrasena;
        $usuario->TIPO_id = $tipo;
        $usuario->ESTADO_id = $estado;

        if( $usuario->save()){
            $resultado = true;
            $mensaje = 'OK: usuario editado';
        } else {
            $resultado = false;
            $mensaje = 'ERROR: No edita usuario';
        }

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado,
            'mensaje' => $mensaje
        ]);
    }

    public static function getUsuarioIdByNombre($usuario_nombre)
    {
        $usuario = Usuario::buscarUsuario($usuario_nombre);

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
        $usuario = Usuario::buscarUsuario($usuario_nombre);
        return ($usuario != null) ? $usuario->id : false;
    }

    public function existeUsuario($usuario_nombre)
    {
        $usuario = \App\Usuario::where('nombre', '=', $usuario_nombre)
            ->get()
            ->first();

        if ($usuario != null) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false
            ]);
        }
    }

    public static function getUsuarioNombreById($usuario_id)
    {
        $usuario = \App\Usuario::find($usuario_id);
        return $usuario->nombre;
    }

    public static function buscarUsuario($usuario_nombre)
    {
        $usuario = \App\Usuario::where('nombre', '=', $usuario_nombre)
            ->where('ESTADO_id', '=', 1)
            ->get()
            ->first();

        return ($usuario != null) ? $usuario : null;
    }

    public function restaurar()
    {
        $id = $_REQUEST['id'];

        $usuario = \App\Usuario::find($id);

        if ($usuario != null) {
            $usuario->ESTADO_id = 1;
            $usuario->save();

            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'usuario_id' => $usuario->id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false
            ]);
        }
    }

    public function cargarVistaListaUsuario()
    {
        $data['filtro'] = $_REQUEST['filtro'];
        $data['valor_a_buscar'] = $_REQUEST['valor_a_buscar'];
        $data['ver_inactivos'] = $_REQUEST['ver_inactivos'];
        $data['tdu'] = $_REQUEST['tdu'];
        $data['Usuario'] = $this;

        $this->load->view('usuario/listado', $data);
    }
}