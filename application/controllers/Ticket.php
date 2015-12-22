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
        $conteo_tickets = \App\Ticket::where('fecha', '=', date('Y-m-d'))
            ->get()
            ->count();
        return $conteo_tickets;
    }

    public static function contarTicketVigentesHoy()
    {
        $conteo_tickets = \App\Ticket::where('fecha', '=', date('Y-m-d'))
            ->whereIn('ESTADO_id', [10, 11])
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
        }
        $conteo_tickets = \App\Ticket::where('ESTADO_id', '=', $estado)
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

    public function cargarTicket($ticket_id)
    {
        if ($ticket_id == -1) {
            $tickets = \App\Ticket::all();
        } else {
            $tickets = \App\Ticket::where('id', '=', $ticket_id)
                ->get();
        }

        return $tickets;
    }
}