<?php

class Ticket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('reserva/ticket');
    }

    public static function contarTicketHoy()
    {
        $conteo_tickets = \App\Ticket::where('fecha', '=', Escritorio::getFechaEcuador() )
            ->get()
            ->count();
        return $conteo_tickets;
    }

    public static function contarTicketVigentesHoy()
    {
        $conteo_tickets = \App\Ticket::where('fecha', '=', Escritorio::getFechaEcuador() )
            ->whereIn('ESTADO_id', [10])
            ->get()
            ->count();
        return $conteo_tickets;
    }

    public static function contarTicketHoyByEstado($estado)
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
        $conteo_tickets = \App\Ticket::where('ESTADO_id', '=', $estado)
            ->where('fecha', '=', Escritorio::getFechaEcuador() )
            ->get()
            ->count();
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
            'destino_puesto_alquiler' => $destino_puesto_alquiler,
            'fecha' => $fecha,
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

    public function cargarListaTicketPorEstacion($estacion_id, $estado_id)
    {
        $data['estacion_id'] = $estacion_id;
        $data['estado_id'] = $estado_id;
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

    public function cargarTicketPorEstacionEstado($estacion_id, $estado_id)
    {
        //todas
        if ($estacion_id == -1 && $estado_id == -1) {
            $tickets = \App\Ticket::all();
        }

        //por estacion
        if ($estacion_id != -1 && $estado_id == -1) {
            $tickets = \App\Ticket::where('destino_puesto_alquiler', '=', $estacion_id)
                ->get();
        }

        //por estado
        if ($estacion_id == -1 && $estado_id != -1) {
            $tickets = \App\Ticket::where('ESTADO_id', '=', $estado_id)
                ->get();
        }

        //por estacion y estado
        if ($estacion_id != -1 && $estado_id != -1) {
            $tickets = \App\Ticket::where('destino_puesto_alquiler', '=', $estacion_id)
                ->where('ESTADO_id', '=', $estado_id)
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

            case 'usuario':
                $campo = 'USUARIO_id';
                break;

            case 'bicicleta':
                $valor = Bicicleta::getIdBicicletaByCodigoDevolver($valor);
                $campo = 'BICICLETA_id';
                break;

        }
        $ticket = \App\Ticket::where($campo, '=', $valor)
            ->get()
            ->first();

        return $ticket;
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


}