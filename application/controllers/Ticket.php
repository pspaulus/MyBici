<?php

class Ticket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['Ticket'] = $this;
        $data['Estacion'] = new Estacion();
        $data['Estado'] = new Estado();

        $this->load->view('reserva/reserva', $data);
    }

    public function cargarBotonCrear()
    {
        $tdu = $_REQUEST["tdu"];
        if ($tdu == 1 || $tdu == 8) {
            echo '<a class="dedo" data-toggle="modal" data-target="#crearTicket"> <i class="fa fa-plus-circle"></i> </a>';
        }
    }

    public function cargarVistaCrear()
    {
        $data['Usuario'] = new Usuario();
        $data['Ticket'] = $this;
        $data['tdu'] = $_REQUEST["tdu"];
        $this->load->view('reserva/crear', $data);
    }

    public static function contarTicketHoy()
    {
        $conteo_tickets = \App\Ticket::where('fecha', '=', Escritorio::getFechaEcuador())
            ->get()
            ->count();

        return $conteo_tickets;
    }

    public static function mostrarConteTicketHoy()
    {
        $conteo_tickets = \App\Ticket::where('fecha', '=', Escritorio::getFechaEcuador())
            ->get()
            ->count();

        return $conteo_tickets;
    }

    public static function contarTicketVigentesHoy($estacion_id)
    {
        if ($estacion_id == -1){
            $conteo_tickets = \App\Ticket::where('fecha', '=', Escritorio::getFechaEcuador())
                ->whereIn('ESTADO_id', [10])
                ->get()
                ->count();
        } else {
            $conteo_tickets = \App\Ticket::where('fecha', '=', Escritorio::getFechaEcuador())
                ->whereIn('ESTADO_id', [10])
                ->where('origen_puesto_alquiler', '=', $estacion_id)
                ->get()
                ->count();
        }
        return $conteo_tickets;
    }

    public static function contarTicketHoyByEstado($estado,$estacion_id)
    {
        switch ($estado) {
            case 'realizadas':
                $estado = 12;
                break;
            case 'anuladas':
                $estado = 13;
                break;
            case 'en_curso':
                $estado = 11;
                break;
        }

        if($estacion_id != -1) {
            $conteo_tickets = \App\Ticket::where('ESTADO_id', '=', $estado)
                ->where('fecha', '=', Escritorio::getFechaEcuador())
                ->where('origen_puesto_alquiler', '=', $estacion_id)
                ->get()
                ->count();
        }else{
            $conteo_tickets = \App\Ticket::where('ESTADO_id', '=', $estado)
                ->where('fecha', '=', Escritorio::getFechaEcuador())
                ->get()
                ->count();
        }
        return $conteo_tickets;
    }

    public static function cargarUltimoId()
    {
        $conteo = \App\Ticket::all()
            ->count();

        return $conteo + 1;
    }

    public function guardarTicket()
    {
        $ticket_id = $_REQUEST['id'];
        $TIPO_id = $_REQUEST['TIPO_id'];
        $USUARIO_id = $_REQUEST['USUARIO_id'];
        $BICICLETA_codigo = $_REQUEST['BICICLETA_codigo'];
        $BICICLETA_id = Bicicleta::getIdBicicletaByCodigoDevolver($BICICLETA_codigo);
        $origen_puesto_alquiler = $_REQUEST['origen_puesto_alquiler'];
        $origen_estacionamiento = Estacionamiento::getEstacionamiento($BICICLETA_id);
        $destino_estacionamiento = null;
        $destino_puesto_alquiler = $_REQUEST['destino_puesto_alquiler'];
        $fecha = $_REQUEST['fecha'];
        $hora_retiro = $_REQUEST['hora_retiro'];
        $hora_entrega = $_REQUEST['hora_entrega'];
        $duracion = $_REQUEST['duracion'];
        $ESTADO_id = $_REQUEST['ESTADO_id'];

        $ticket_nuevo = \App\Ticket::firstOrCreate([
            'TIPO_id' => $TIPO_id,
            'USUARIO_id' => $USUARIO_id,
            'BICICLETA_id' => $BICICLETA_id,
            'origen_puesto_alquiler' => $origen_puesto_alquiler,
            'origen_estacionamiento' => $origen_estacionamiento,
            'destino_puesto_alquiler' => $destino_puesto_alquiler,
            'destino_estacionamiento' => $destino_estacionamiento,
            'fecha' => Escritorio::getFechaHoraEcuador(),
            'hora_creacion' => Escritorio::getHoraEcuador(),
            'hora_retiro' => $hora_retiro,
            'hora_entrega' => $hora_entrega,
            'duracion' => $duracion,
            'ESTADO_id' => $ESTADO_id
        ]);

        if ($ticket_nuevo != null) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'ticket_nuevo_id' => $ticket_nuevo->id,
                'ticket_bicicleta_id' => $BICICLETA_id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false
            ]);
        }
    }

    public function cargarListaTicketPorEstacion($estacion_id, $estado_id, $fecha)
    {
        $data['estacion_id'] = $estacion_id;
        $data['estado_id'] = $estado_id;
        $data['fecha'] = $fecha;
        $data['filtro'] = 'estacion';

        $this->load->view('reserva/listado', $data);
    }

    public function cargarListaTicketPorCampo($campo, $valor)
    {
        $data['campo'] = $campo;
        $data['valor'] = $valor;
        $data['filtro'] = 'campo';

        $this->load->view('reserva/listado', $data);
    }

    public function cargarTicketPorEstacionEstado($estacion_id, $estado_id, $fecha)
    {
        //todas
        if ($estacion_id == -1 && $estado_id == -1) {
            $tickets = \App\Ticket::where('fecha','=',$fecha)
                ->get();
        }

        //por estacion
        if ($estacion_id != -1 && $estado_id == -1) {
            $tickets = \App\Ticket::where('destino_puesto_alquiler', '=', $estacion_id)
                ->where('fecha','=',$fecha)
                ->get();
        }

        //por estado
        if ($estacion_id == -1 && $estado_id != -1) {
            $tickets = \App\Ticket::where('ESTADO_id', '=', $estado_id)
                ->where('fecha','=',$fecha)
                ->get();
        }

        //por estacion y estado
        if ($estacion_id != -1 && $estado_id != -1) {
            $tickets = \App\Ticket::where('destino_puesto_alquiler', '=', $estacion_id)
                ->where('ESTADO_id', '=', $estado_id)
                ->where('fecha','=',$fecha)
                ->get();
        }

        return $tickets;
    }

    public function cargarTicket($campo_tipo, $valor)
    {
        switch ($campo_tipo) {
            case 'id':
                $campo = 'id';
                break;

            case 'bicicleta':
                $valor = Bicicleta::getIdBicicletaByCodigoDevolver($valor);
                $campo = 'BICICLETA_id';
                break;

            case 'usuario':
                $campo = 'USUARIO_id';
                $valor = Usuario::getUsuarioIdByNombreDevolver($valor);
                break;

        }
        $tickets = \App\Ticket::where($campo, '=', $valor)
            ->get();

        return $tickets;
    }

    public function cambiarEstado($ticket_id, $estado_descripcion)
    {
        switch ($estado_descripcion) {
            case 'anulada':
                $estado_id = 13;
                break;

            case 'realizada':
                $estado_id = 12;
                break;

            case 'en_curso':
                $estado_id = 11;
                break;

            case 'generada':
                $estado_id = 10;
                break;
        }

        $ticket = \App\Ticket::find($ticket_id);
        $ticket->ESTADO_id = $estado_id;
        $ticket->save();

        if ($ticket->ESTADO_id == $estado_id) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'ticket_id' => $ticket->id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function marcarHora($ticket_id, $tipo_hora)
    {
        $ticket = \App\Ticket::find($ticket_id);

        if ($tipo_hora == 'retiro') {
            $ticket->hora_retiro = Escritorio::getHoraEcuador();
        } elseif ($tipo_hora == 'entrega') {
            $ticket->hora_entrega = Escritorio::getHoraEcuador();
        }

        if ($ticket->save()) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function getTicketBiciccleta_id($ticket_id)
    {
        $ticket = \App\Ticket::find($ticket_id);

        if ($ticket != null) {
            $bicicleta_id = $ticket->BICICLETA_id;

            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'bicicleta_id' => $bicicleta_id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function cambiarEstadoBicicleta($ticket_id, $estado_texto)
    {
        $ticket = \App\Ticket::find($ticket_id);

        $bicicleta_id = $ticket->BICICLETA_id;

        switch ($estado_texto) {
            case 'danada': //dañada
                $estado_id = 8;
                break;

            case 'reparar': //reparar
                $estado_id = 3;
                break;

            case 'buena': //buena
                $estado_id = 7;
                break;

            case 'en_reserva': //en_uso
                $estado_id = 9;
                break;

            case 'en_uso': //en_uso
                $estado_id = 6;
                break;
        }

        $bicicleta = \App\Bicicleta::find($bicicleta_id);
        $bicicleta->ESTADO_id = $estado_id;

        if ($bicicleta->save()) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'bicicleta_id' => $bicicleta_id
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
            ]);
        }

    }

    public function RecargarResumen()
    {
        //$data['Ticket'] = $this;
        $data['estacion_id'] = $_REQUEST['estacion_id'];

        $this->load->view('reserva/resumen', $data);
    }

    public function barrerTicket()
    {
        $quince_minutos_antes = date('H:i:s', time() - ((60 * 60) * 5) - (15 * 60));
        $tickets = \App\Ticket::where('fecha','<=',Escritorio::getFechaEcuador())
            ->where('hora_creacion','<', $quince_minutos_antes )
            ->whereNotIn('ESTADO_id', [11,12,13])
            ->get();


        //dd($tickets,$quince_minutos_antes);
        $i = 0;
        if (count($tickets) > 0){

            foreach($tickets as $ticket){
                $i++;
                $this->cambiarEstado($ticket->id, 'anulada');
                $this->cambiarEstadoBicicleta($ticket->id, 'buena');
            }
        }

        $mensaje = '<i class="fa fa-check"></i> Se han anulado '. $i .' tickets por expiraci&oacute;n';

        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
            'mensaje' => $mensaje
        ]);
    }
}