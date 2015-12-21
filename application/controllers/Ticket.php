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

    }
}