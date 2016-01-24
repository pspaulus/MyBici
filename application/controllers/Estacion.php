<?php

class Estacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('estacion/estacion');
    }

    public function cargarVistaCrear()
    {
        $data['Estacion'] = $this;
        $tdu = $_REQUEST["tdu"];
        if ($tdu == 1){
            $this->load->view('estacion/crear', $data);
        }
    }

    public function cargarBotonCrear() {
        $tdu = $_REQUEST["tdu"];
        if ($tdu == 1){
            echo '<a class="dedo" data-toggle="modal" data-target="#crearEstacion"> <i class="fa fa-plus-circle"></i> </a>';
        }
    }

    public function cargarBotonesEditar(){
        $tdu = $_REQUEST["tdu"];
        if ($tdu == 1){
            echo '<!-- Button editar -->
                    <button type="button" class="btn btn-warning" title="Editar Estaci&oacute;n"
                            id="btn_editar_estacion" onclick="Estacion.acciones.editar()"><i class="fa fa-edit"></i>
                    </button>

                    <!-- Button guardar -->
                    <button type="button" class="btn btn-success" title="Actualizar Estaci&oacute;n"
                            id="btn_guardar_estacion" onclick="Estacion.acciones.guardarEditar();"><i class="fa fa-check"></i>
                    </button>
                    <script>
                        Estacion.validaciones.botonGuardar("ocultar");
                    </script>';
        }
    }

    public function cargarBotonesEditarCantidad(){
        $tdu = $_REQUEST["tdu"];
        if ($tdu == 1){
            echo '<!-- Button trigger modal crear estacionamiento -->
                <button type="button" class="btn btn-primary" title="Agrgar estacionamientos" data-toggle="modal"
                        id="btn_crear_estacionamiento" data-target="#crear_estacionamiento" disabled><i
                        class="fa fa-plus"></i></button>
                <!-- button trigger modal eliminar estacionamiento -->
                <button type="button" class="btn btn-danger" title="Elimnar estacionamientos" data-toggle="modal"
                        id="btn_eliminar_estacionamiento" data-target="#eliminar_estacionamiento" disabled><i
                        class="fa fa-minus"></i></button>';
            $this->load->view('estacionamiento/crear');
            $this->load->view('estacionamiento/eliminar');
        }
    }

    public function existeCodigo($estacion_codigo, $estacion_id = null)
    {
        $estacion = \App\Estacion::where('codigo', '=', $estacion_codigo)
            ->whereNotIn('id', [$estacion_id])
            ->get()
            ->first();

        $resultado = ($estacion != null) ? true : false;

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado
        ]);
    }

    public function existeNombre($estacion_nombre)
    {
        $estacion = \App\Estacion::where('nombre', '=', $estacion_nombre)
            ->get()
            ->first();

        $resultado = ($estacion != null) ? true : false;

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado
        ]);
    }

    public function existeEditarNombre($estacion_nombre, $estacion_id = null)
    {
        $estacion = \App\Estacion::where('nombre', '=', $estacion_nombre)
            ->whereNotIn('id', [$estacion_id])
            ->get()
            ->first();

        $resultado = ($estacion != null) ? true : false;

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado
        ]);
    }

    public function crearEstacion()
    {
        $nombre = $_REQUEST['nombre'];
        $codigo = $_REQUEST['codigo'];
        $longitud = $_REQUEST['longitud'];
        $latitud = $_REQUEST['latitud'];

        $estaciones = \App\Estacion::where('nombre', '=', $nombre)
            ->orwhere('codigo', '=', $codigo)
            ->get();

        if ($estaciones->first() == null) {
            $nueva_estacion = \App\Estacion::firstOrCreate([
                'nombre' => $nombre,
                'codigo' => $codigo,
                'longitud' => $longitud,
                'latitud' => $latitud
            ]);

            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'mensaje' => 'Ok al guardar Estacion -> '. $nueva_estacion->id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
                'mensaje' => 'ERROR: al guardar Estacion'
            ]);
        }
    }

    public function cargarUltimoId()
    {
        $estacion = \App\Estacion::all()->last();
        return $estacion->id + 1;
    }

    public function cargarEstaciones()
    {
        $estaciones = \App\Estacion::all();
        return $estaciones;
    }

    public static function getCodigoEstacion($id)
    {
        $estacion = \App\Estacion::find($id);
        return $estacion->codigo;
    }

    public static function getNombreEstacion($id)
    {
        $estacion = \App\Estacion::find($id);
        return $estacion->nombre;
    }

    public static function getIdByCodigo($codigo)
    {
        $estacion = \App\Estacion::where('codigo', '=', $codigo)
            ->get()
            ->first();
        return ($estacion == null) ? null : $estacion->id;

    }

    public static function getCodigoEstacionById($id)
    {
        $estacion = \App\Estacion::find($id);
        echo ($estacion != null) ? $estacion->codigo : null;
    }

    public static function getCodigoEstacionByIdDevolver($id)
    {
        $estacion = \App\Estacion::find($id);
        return ($estacion != null) ? $estacion->codigo : null;
    }

    public static function cargarEstacion($id)
    {
        return $estacion = \App\Estacion::find($id);
    }

    public function cargarDatosEstacion($id)
    {
        $data['estacion_actual'] = $this->cargarEstacion($id);
        $data['Estacion'] = $this;

        $this->load->view('estacion/datos', $data);
    }

    public function editarEstacion()
    {
        $estacion_id = $_REQUEST['id'];
        $codigo = $_REQUEST['codigo'];
        $nombre = $_REQUEST['nombre'];
        $longitud = $_REQUEST['longitud'];
        $latitud = $_REQUEST['latitud'];

        $estacion = \App\Estacion::find($estacion_id);
        $estacion->codigo = $codigo;
        $estacion->nombre = $nombre;
        $estacion->longitud = $longitud;
        $estacion->latitud = $latitud;

        $resultado = $estacion->save();

        if ($resultado) {
            $mensaje = 'OK: edita estacion -> ' . $estacion->id;
        } else {
            $mensaje = 'ERROR: no edita';
        }
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $resultado,
            'mensaje' => $mensaje
        ]);
    }

    public static function getCodigoEstacionByIdRetornar($id)
    {
        $estacion = \App\Estacion::find($id);
        return ($estacion != null) ? $estacion->codigo : null;
    }

    public static function getEstacionNombreById($estacion_id)
    {
        $estacion = \App\Estacion::find($estacion_id);
        return $estacion->nombre;
    }

    public static function getEstacionNombreByCodigo($estacion_codigo)
    {

        $estacion = \App\Estacion::where('codigo', '=', $estacion_codigo)
            ->get()
            ->first();
        return ($estacion != null) ? $estacion->nombre : null;
    }

    public function selectEstacion()
    {
        $estaciones = $this->cargarEstaciones();

        if ($estaciones != null) {
            $select = '<select id="select_estacion" class="form-control" onchange="Estacion.acciones.cargarDatosEstacion()">';

            foreach ($estaciones as $estacion) {
                $select .= '<option value="' . $estacion->id . '">' . $estacion->codigo . ' - ' . $estacion->nombre . '</option>';
            }
            $select .= '</select>';

            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'html' => $select
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false
            ]);
        }
    }
}